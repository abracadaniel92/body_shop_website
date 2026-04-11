import { CONFIG } from './config'

function formatDate (dateStr) {
  const date = new Date(dateStr)
  return date.toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric'
  })
}

function parseCSVLine (line) {
  const values = []
  let current = ''
  let inQuotes = false

  for (let i = 0; i < line.length; i++) {
    const char = line[i]
    if (char === '"') {
      inQuotes = !inQuotes
    } else if (char === ',' && !inQuotes) {
      values.push(current.trim())
      current = ''
    } else {
      current += char
    }
  }
  values.push(current.trim())
  return values
}

function parseCSV (csv) {
  const lines = csv.split(/\r?\n|\r/).filter((line) => line.trim())
  if (lines.length < 2) {
    return []
  }

  const tours = []

  for (let i = 1; i < lines.length; i++) {
    const line = lines[i].trim()
    if (!line) continue

    const values = parseCSVLine(line)

    if (values.length >= 3) {
      tours.push({
        date: values[0]?.trim() || '',
        venue: values[1]?.trim() || 'Event',
        location: values[2]?.trim() || 'Location TBA',
        description: values[3]?.trim() || ''
      })
    }
  }

  return tours
}

let toursCache = null
let toursCacheTime = null
const CACHE_DURATION = 5 * 60 * 1000

/**
 * Returns processed tour rows for Vue, or { tours: [], error: string }.
 */
export async function fetchToursData () {
  if (!CONFIG.toursGoogleSheetsUrl) {
    return { tours: [], error: 'configure' }
  }

  const now = Date.now()
  if (toursCache && toursCacheTime && (now - toursCacheTime) < CACHE_DURATION) {
    return { tours: toursCache, error: null }
  }

  try {
    const response = await fetch(CONFIG.toursGoogleSheetsUrl)

    if (!response.ok) {
      throw new Error(`HTTP ${response.status}`)
    }

    const csv = await response.text()
    const tours = parseCSV(csv)

    if (tours.length === 0) {
      return { tours: [], error: 'empty' }
    }

    const currentDate = new Date()
    const daysToKeepPast = 7
    const cutoffDate = new Date(currentDate)
    cutoffDate.setDate(cutoffDate.getDate() - daysToKeepPast)

    const relevantTours = tours
      .filter((tour) => {
        if (!tour.date) return false
        const tourDate = new Date(tour.date)
        return tourDate >= cutoffDate
      })
      .map((tour) => {
        const tourDate = new Date(tour.date)
        return {
          ...tour,
          eventDate: tourDate,
          isPast: tourDate < currentDate,
          dateLabel: formatDate(tour.date)
        }
      })
      .sort((a, b) => a.eventDate - b.eventDate)
      .slice(0, 15)

    if (relevantTours.length === 0) {
      return { tours: [], error: 'none' }
    }

    toursCache = relevantTours
    toursCacheTime = now
    return { tours: relevantTours, error: null }
  } catch (err) {
    console.error('Error fetching tours:', err)
    return { tours: [], error: 'fetch' }
  }
}

export { formatDate }
