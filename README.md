# The Founder-led Personal Brand Playbook

A free 10-page playbook on how founders build a personal brand in 2026 — and turn their face into their business's cheapest distribution channel.

By **[@smmguy](https://instagram.com/smmguy)**.

---

## What's in this repo

| File | What it is |
|---|---|
| `index.html` | **Static landing page** — works on GitHub Pages, Netlify, Vercel, Cloudflare Pages |
| `index.php` | **Dynamic landing page** — for hosts that run PHP (Hostinger, SiteGround, cPanel) |
| `playbook.pdf` | The 10-page deliverable |
| `playbook.html` | Source HTML used to generate the PDF |
| `README.md` | This file |

---

## Where do the emails go?

**This site uses [Superprofile](https://superprofile.bio/smmguy) for email capture and PDF delivery.**

Every "GET THE PLAYBOOK" button on the page links to:
```
https://superprofile.bio/smmguy
```

When a visitor clicks → Superprofile collects their email → delivers the PDF.
Your subscriber list + analytics live in the **Superprofile dashboard** — fully exportable.

To change the destination URL, search-and-replace `https://superprofile.bio/smmguy` in `index.html` (it appears in 3 places: nav button, hero CTA, final CTA).

### Want to swap to a different provider?
- **Direct email capture on this page** — see `index.php` (uses PHP + writes to `subscribers.csv`), or wire any of [Formspree](https://formspree.io), [Web3Forms](https://web3forms.com), [Tally](https://tally.so) into the buttons
- **Self-host on PHP** — use `index.php` instead of `index.html` on Hostinger / SiteGround / any cPanel host. Emails saved to `subscribers.csv` in the same folder.

---

## Deploy to GitHub Pages (free hosting)

GitHub Pages serves `index.html` for free at `https://YOUR-USERNAME.github.io/REPO-NAME/`.

### One-time setup

```bash
cd /Users/ashishkumawat/Miscellaneous/founder-brand-playbook

# Initialize git (already done if README is here)
git init -b main
git add .
git commit -m "Initial: founder-led personal brand playbook"
```

### Create the GitHub repo

**Easiest** — through the website:
1. Go to **[github.com/new](https://github.com/new)**
2. Name it: `founder-brand-playbook` (or whatever you like)
3. Set **Public** (required for free GitHub Pages)
4. **Don't** initialize with README — we have one
5. Click **Create repository**
6. Copy the repo URL it shows you, then back in your terminal:

```bash
git remote add origin https://github.com/YOUR-USERNAME/founder-brand-playbook.git
git push -u origin main
```

### Turn on GitHub Pages

1. In your new repo → **Settings** → **Pages** (left sidebar)
2. **Source:** Deploy from a branch
3. **Branch:** `main` · **Folder:** `/ (root)` → **Save**
4. Wait ~60 seconds. Your site is live at:
   `https://YOUR-USERNAME.github.io/founder-brand-playbook/`

### Add a custom domain (optional)
1. In **Settings → Pages → Custom domain**, enter e.g. `playbook.smmguy.com`
2. At your DNS provider, add a CNAME record:
   `playbook → YOUR-USERNAME.github.io`
3. Tick **Enforce HTTPS** once the cert provisions (~10 min)

---

## Local preview

**Static (just open the HTML):**
```bash
# Quick: open in browser directly
open index.html

# Better: serve over a local server (so paths work properly)
python3 -m http.server 8000
# then visit http://localhost:8000
```

**PHP version (needs PHP installed):**
```bash
php -S localhost:8000
# visit http://localhost:8000  (uses index.php automatically)
```

---

## File checklist before pushing to GitHub

- [ ] `index.html` — Web3Forms key pasted (or replaced with Superprofile button)
- [ ] `playbook.pdf` — present
- [ ] `subscribers.csv` — **NOT** in the repo (it's in `.gitignore`; only generated server-side anyway)
- [ ] Test the form locally first

---

Built by **[@smmguy](https://instagram.com/smmguy)** · 2026
