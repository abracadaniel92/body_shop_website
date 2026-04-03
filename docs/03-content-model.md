# Content Model

## Pages

- `Home` (static page using homepage template)
  - Hero title
  - Hero subtitle
  - Hero CTA label
  - Hero CTA URL
  - Services section title
  - Contact section title

- `Gallery` (static page using gallery template)
  - Intro title
  - Intro text

## Custom Post Type: Gallery Item

- Post type slug: `gallery_item`
- Supports: title, editor, thumbnail
- Custom fields:
  - `before_image_id` (media attachment ID)
  - `after_image_id` (media attachment ID)
  - `service_type` (text)
  - `vehicle_info` (text)

## Blog

- Native WordPress `post` type
- Supports categories, tags, featured image, excerpt

## Navigation

- Menu location: `primary`
- Required items:
  - Home
  - Gallery
  - Blog
  - Contact (anchor on homepage)
