# 📦 WordPress Responsive Post Grid Shortcode

A lightweight and customizable WordPress shortcode that displays blog posts in a responsive card layout. Automatically handles categories, excerpt fallback, mobile responsiveness, and layout logic (4-per-row on desktop, wrap on overflow).

---

## 🚀 Features

* ✅ Responsive grid layout (4 per row on desktop)
* 📱 Mobile-friendly (1 per row on mobile)
* 🧠 Automatically trims excerpt or fallback to post content
* 💂 Category filtering (comma-separated support)
* ➕ Skip posts with `skip` parameter (offset)
* 📦 No external dependencies

---

## 🧹 Shortcode

```php
[custom_posts]
```

### 🔧 Available Parameters

| Parameter  | Description                            | Example                               |
| ---------- | -------------------------------------- | ------------------------------------- |
| `posts`    | Number of posts to show (default: `8`) | `[custom_posts posts=6]`              |
| `category` | Category slug(s), comma-separated      | `[custom_posts category=offers,news]` |
| `skip`     | Number of posts to skip (offset)       | `[custom_posts skip=2 posts=4]`       |

---

## 🖐️ Layout Behavior

| Screen Width       | Columns Per Row |
| ------------------ | --------------- |
| Desktop (≥ 1024px) | 4               |
| Tablet (≤ 1024px)  | 2               |
| Mobile (≤ 600px)   | 1               |

---

## 💪 Installation

1. Copy the PHP code into your theme’s `functions.php` file **or** build it as a custom plugin.
2. Add the shortcode `[custom_posts]` anywhere in your pages/posts or template files.

---
## 💡 Example Use Cases

* Recent news blocks
* Blog widgets
* Category-specific featured posts
* Homepage post highlights

---

## ✅ To-Do / Improvements

* [ ] Add pagination support
* [ ] Convert to Gutenberg block
* [ ] Add "Load More" AJAX button
* [ ] Add custom post type support

---

## 📄 License

This project is open-sourced under the MIT License.

---

## 🤝 Contributing

Pull requests and suggestions are welcome! Let’s make it better together.
