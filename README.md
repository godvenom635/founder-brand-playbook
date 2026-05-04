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

You have **three options**, ranked simplest → most flexible:

### Option 1 — **Superprofile** (or Stan / Beacons / Tally) — *no code, fastest*
Use your existing Superprofile lead-magnet feature. Skip the form on this site entirely:
1. In Superprofile, create a "Free Lead Magnet" → upload `playbook.pdf` → set email-required
2. Copy the public Superprofile URL
3. In `index.html`, replace **both** `<form class="capture js-form">…</form>` blocks with a single button:
   ```html
   <a class="download" href="https://yoursuperprofile.link/playbook">GET THE PLAYBOOK →</a>
   ```
4. Emails land in your **Superprofile dashboard** — full subscriber list, exportable.

> **Pros:** zero setup, hosted dashboard, native CRM features, built-in email delivery.
> **Cons:** less brand control on the capture step.

### Option 2 — **Web3Forms** (default in this repo) — *free, unlimited, 1-min setup*
The form in `index.html` is already wired for Web3Forms. To activate:
1. Go to **[web3forms.com](https://web3forms.com)** → enter your email → instantly get an access key
2. Open `index.html`, find this line near the bottom:
   ```js
   const ACCESS_KEY = 'YOUR_WEB3FORMS_ACCESS_KEY';
   ```
3. Paste your key. That's it.
4. Submissions land in **your inbox** + the Web3Forms dashboard (web3forms.com/dashboard).

> **Pros:** unlimited submissions free, no spam protection limits, no signup wall.
> **Cons:** basic dashboard — no segmentation/automations.

### Option 3 — **Self-hosted on PHP** (using `index.php`)
If you host on Hostinger / SiteGround / any cPanel host with PHP:
1. Upload the whole folder via FTP / file manager
2. Make sure the directory is writable (`chmod 755`) so PHP can create `subscribers.csv`
3. Emails saved to `subscribers.csv` in the same folder — download anytime via FTP

> **Pros:** you own the data fully, no third party.
> **Cons:** requires a PHP host (not GitHub Pages), no email notifications by default.

**Other free swaps for the form:** [Formspree](https://formspree.io) (50/mo free), [Tally](https://tally.so) (unlimited free), [Getform](https://getform.io). All use the same `<form action="…">` pattern — just change the endpoint and field names.

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
