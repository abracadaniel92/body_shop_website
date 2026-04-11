# CENTAR SRBIJA STIL

A modern, brutalist-inspired website for CENTAR SRBIJA STIL record label. Built with Vue.js 3 and Vite, featuring a dark, minimalist aesthetic with bold typography and high contrast design.

## Features

- **Hero Section**: Split-screen layout with image overlays and bold typography
- **News Feed**: Dynamic news feed powered by Google Sheets
- **Tours Section**: Upcoming tour dates from Google Calendar (iCal)
- **Music Section**: SoundCloud player with album/single image gallery
- **Merch Section**: Horizontal carousel with clickable merch items
- **About/History Section**: Label information and history
- **Responsive Design**: Fully responsive across all devices

## Tech Stack

- **Vue.js 3**: Progressive JavaScript framework
- **Vite**: Next-generation frontend build tool
- **CSS3**: Custom styling with brutalist design principles

## Getting Started

### Prerequisites

- Node.js (v16 or higher)
- npm or yarn

### Installation

1. Clone the repository:
```bash
git clone https://github.com/abracadaniel92/centar-srbija-stil.git
cd centar-srbija-stil
```

2. Install dependencies:
```bash
npm install
```

3. Start the development server:
```bash
npm run dev
```

The site will be available at `http://localhost:3000`

### Build for Production

```bash
npm run build
```

The production build will be in the `dist` directory.

## Configuration

### Setting Up External Data Sources

Edit `src/utils/config.js` to add your data sources:

```javascript
export const CONFIG = {
    icalUrl: 'YOUR_GOOGLE_CALENDAR_ICAL_URL', // For tour dates
    googleSheetsId: 'YOUR_GOOGLE_SHEETS_ID', // For news feed
    soundcloudUrl: 'YOUR_SOUNDCLOUD_EMBED_URL' // For music player
}
```

### Google Calendar (Tours)

1. Open your Google Calendar
2. Go to Settings → Integrate calendar
3. Copy the "Public URL to iCal format" link
4. Paste it in `config.js` as `icalUrl`

### Google Sheets (News Feed)

1. Create a Google Sheet with columns: Date, Title, Content, Image (optional)
2. Publish the sheet: File → Share → Publish to web → CSV format
3. Copy the Sheet ID from the URL (the long string between `/d/` and `/edit`)
4. Paste it in `config.js` as `googleSheetsId`

**Sheet Format:**
```
Date,Title,Content,Image
2024-01-15,News Title,News content here,https://image-url.jpg
```

### SoundCloud Player

1. Go to your SoundCloud track
2. Click Share → Embed
3. Copy the embed code URL
4. The player will automatically load when you add the embed code

### Merch Links

Edit `src/components/MerchSection.vue` to update merch item links:

```javascript
const merchItems = ref([
  { image: '../../images/1.jpg', alt: 'Merch Item 1', link: 'https://your-merch-site.com' },
  // Add more items...
])
```

## Project Structure

```
css/
├── src/
│   ├── components/
│   │   ├── AboutSection.vue      # History/About section
│   │   ├── Footer.vue             # Footer component
│   │   ├── HeroSection.vue        # Hero banner
│   │   ├── MerchSection.vue       # Merch carousel
│   │   ├── Navigation.vue        # Top navigation
│   │   ├── NewsSection.vue        # News feed
│   │   ├── SoundCloudSection.vue  # Music player section
│   │   └── ToursSection.vue       # Tour dates section
│   ├── utils/
│   │   ├── config.js              # Configuration file
│   │   ├── news.js                # News fetching logic
│   │   ├── soundcloud.js          # SoundCloud embed logic
│   │   └── tours.js               # Tour dates parsing
│   ├── App.vue                    # Main app component
│   └── main.js                    # App entry point
├── images/                        # Image assets
├── fonts/                         # Font files
├── index.html                     # HTML entry point
├── package.json                   # Dependencies
└── vite.config.js                 # Vite configuration
```

## Customization

### Colors

The color scheme is defined in `styles.css`:

```css
:root {
    --bg-black: #0a0a0a;
    --bg-dark: #1a1a1a;
    --text-white: #ffffff;
    --text-gray: #666666;
}
```

### Fonts

The site uses:
- **Inter**: Main sans-serif font (loaded from Google Fonts)
- **Betmo**: Custom script font for special accents (included in `fonts/`)

### Images

Place your images in the `images/` folder:
- `logo.jpg` - Logo for navigation
- `1.jpg`, `2.jpg`, `3.jpg` - Hero and gallery images

## Deployment

### Vercel

1. Install Vercel CLI: `npm i -g vercel`
2. Run `vercel` in the project directory
3. Follow the prompts

### Netlify

1. Build the project: `npm run build`
2. Drag and drop the `dist` folder to Netlify
3. Or connect your GitHub repository for automatic deployments

### GitHub Pages

1. Build the project: `npm run build`
2. Push the `dist` folder to the `gh-pages` branch
3. Enable GitHub Pages in repository settings

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

All rights reserved. CENTAR SRBIJA STIL © 2024

## Contact

For questions or support, please contact the label directly.
