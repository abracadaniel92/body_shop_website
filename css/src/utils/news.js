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

  const news = []

  for (let i = 1; i < lines.length; i++) {
    const line = lines[i].trim()
    if (!line) continue

    const values = parseCSVLine(line)

    if (values.length >= 3) {
      news.push({
        date: values[0]?.trim() || new Date().toISOString(),
        title: values[1]?.trim() || 'Untitled',
        content: values[2]?.trim() || '',
        image: values[3]?.trim() || ''
      })
    }
  }

  return news
}

/**
 * Returns sorted news items for Vue, or { news: [], error: string }.
 */
export async function fetchNewsData () {
  if (!CONFIG.googleSheetsUrl) {
    return { news: [], error: 'configure' }
  }

  try {
    const response = await fetch(CONFIG.googleSheetsUrl)
    const csv = await response.text()
    const news = parseCSV(csv)

    if (news.length === 0) {
      return { news: [], error: 'empty' }
    }

    const sortedNews = news
      .sort((a, b) => new Date(b.date) - new Date(a.date))
      .slice(0, 6)
      .map((item) => ({
        ...item,
        dateLabel: formatDate(item.date)
      }))

    return { news: sortedNews, error: null }
  } catch (err) {
    console.error('Error fetching news:', err)
    return { news: [], error: 'fetch' }
  }
}

export { formatDate }
