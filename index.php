<?php
// ============================================================
// The Founder-led Personal Brand Playbook — landing page
// by @smmguy · single-file PHP
// ============================================================

$success = false;
$error   = '';
$email   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $valid = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$valid) {
        $error = 'That email looks off — try again?';
    } else {
        $row = [
            date('Y-m-d H:i:s'),
            $email,
            $_SERVER['REMOTE_ADDR']     ?? '',
            $_SERVER['HTTP_USER_AGENT'] ?? '',
            $_SERVER['HTTP_REFERER']    ?? '',
        ];
        $fp = @fopen(__DIR__ . '/subscribers.csv', 'a');
        if ($fp) {
            if (flock($fp, LOCK_EX)) {
                if (filesize(__DIR__ . '/subscribers.csv') === 0) {
                    fputcsv($fp, ['timestamp','email','ip','user_agent','referer']);
                }
                fputcsv($fp, $row);
                flock($fp, LOCK_UN);
            }
            fclose($fp);
        }
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>The Founder-led Personal Brand Playbook — by @smmguy</title>
<meta name="description" content="A free 10-page playbook on how founders build a personal brand in 2026 — and turn their face into their business's cheapest distribution channel.">
<meta property="og:title" content="The Founder-led Personal Brand Playbook">
<meta property="og:description" content="How founders build a personal brand in 2026 — and turn their face into distribution. By @smmguy.">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=DM+Serif+Display:ital@0;1&family=Anton&family=Caveat:wght@500;700&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#0a0a0a;
    --blue:#1d4ed8;
    --deep-blue:#0b2a6b;
    --blue-soft:#eff4ff;
    --blue-line:#c7d6f7;
    --muted:#6b7280;
    --border:#e5e7eb;
    --soft-bg:#fafafa;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{scroll-behavior:smooth;}
  body{
    font-family:'Inter',sans-serif;
    color:var(--ink);
    background:#fff;
    -webkit-font-smoothing:antialiased;
    line-height:1.5;
    overflow-x:hidden;
  }
  a{color:inherit; text-decoration:none;}
  img,svg{max-width:100%; display:block;}

  .container{max-width:1080px; margin:0 auto; padding:0 24px;}

  /* ============== NAV ============== */
  nav.top{
    position:sticky; top:0; z-index:50;
    background:rgba(255,255,255,.92);
    backdrop-filter:blur(12px);
    border-bottom:1px solid var(--border);
  }
  nav.top .inner{
    display:flex; justify-content:space-between; align-items:center;
    padding:14px 24px; max-width:1080px; margin:0 auto;
  }
  nav.top .brand{
    font-weight:900; font-size:14px; letter-spacing:0.18em;
    color:var(--ink);
  }
  nav.top .brand .at{color:var(--blue);}
  nav.top .cta{
    background:var(--ink); color:#fff;
    padding:10px 18px; border-radius:8px;
    font-weight:800; font-size:12px; letter-spacing:0.12em;
    transition:transform .15s ease;
  }
  nav.top .cta:hover{transform:translateY(-1px);}

  /* ============== HERO ============== */
  .hero{
    padding:64px 0 48px;
    background:radial-gradient(ellipse at top, var(--blue-soft) 0%, #fff 60%);
    text-align:center;
  }
  .eyebrow{
    display:inline-block;
    background:var(--blue-soft);
    border:1px solid var(--blue-line);
    color:var(--blue);
    font-weight:800; font-size:11px; letter-spacing:0.20em;
    padding:6px 14px; border-radius:999px;
    margin-bottom:20px;
  }
  .eyebrow .dot{
    display:inline-block; width:8px; height:8px;
    background:var(--blue); border-radius:50%; margin-right:8px;
    vertical-align:middle;
    animation:pulse 1.8s ease-in-out infinite;
  }
  @keyframes pulse{0%,100%{opacity:1;} 50%{opacity:.4;}}

  h1.hero-title{
    font-family:'DM Serif Display',serif;
    font-style:italic;
    font-weight:400;
    font-size:42px;
    line-height:1.05;
    margin-bottom:6px;
  }
  h1 .display{
    display:block;
    font-family:'Anton',sans-serif;
    font-style:normal;
    font-size:120px;
    line-height:.92;
    letter-spacing:-0.02em;
    color:var(--ink);
    margin-top:4px;
  }
  .hero p.subhead{
    max-width:640px; margin:22px auto 0;
    font-size:17px; line-height:1.55;
    color:#1f2937;
  }
  .hero p.subhead .accent{color:var(--blue); font-weight:700;}

  /* Form */
  .form-wrap{
    max-width:520px; margin:32px auto 0;
  }
  form.capture{
    display:flex; gap:8px;
    background:#fff;
    border:1.5px solid var(--ink);
    border-radius:12px;
    padding:6px;
    box-shadow:0 8px 30px rgba(11,42,107,.08);
  }
  form.capture input[type=email]{
    flex:1;
    border:0; outline:0; background:transparent;
    padding:12px 14px;
    font-family:inherit; font-size:15px;
    color:var(--ink);
  }
  form.capture button{
    background:var(--blue); color:#fff;
    border:0; border-radius:8px;
    padding:13px 22px;
    font-family:inherit; font-weight:800;
    font-size:13px; letter-spacing:0.10em;
    cursor:pointer;
    white-space:nowrap;
    transition:transform .15s ease, background .15s ease;
  }
  form.capture button:hover{background:var(--deep-blue); transform:translateY(-1px);}
  .form-meta{
    margin-top:14px;
    font-size:12px; color:var(--muted);
    letter-spacing:0.04em;
  }
  .form-meta b{color:var(--ink); font-weight:700;}

  .err{
    margin-top:10px; color:#b91c1c; font-size:13px; font-weight:600;
  }

  .success-card{
    max-width:520px; margin:32px auto 0;
    background:var(--ink); color:#fff;
    border-radius:14px; padding:24px;
    text-align:center;
    box-shadow:0 12px 40px rgba(11,42,107,.18);
  }
  .success-card .check{
    width:48px; height:48px; border-radius:50%;
    background:var(--blue); margin:0 auto 14px;
    display:flex; align-items:center; justify-content:center;
  }
  .success-card h3{
    font-family:'DM Serif Display',serif; font-style:italic;
    font-size:22px; margin-bottom:6px;
  }
  .success-card p{font-size:13px; opacity:.85; margin-bottom:18px;}
  .success-card .download{
    display:inline-block;
    background:var(--blue); color:#fff;
    padding:14px 28px; border-radius:10px;
    font-weight:800; font-size:13px; letter-spacing:0.14em;
  }

  .trust-row{
    margin-top:28px;
    display:flex; justify-content:center; align-items:center; gap:20px;
    flex-wrap:wrap;
    font-size:11.5px; color:var(--muted);
    letter-spacing:0.08em; font-weight:600;
  }
  .trust-row .pip{
    width:5px; height:5px; background:var(--blue);
    border-radius:50%; display:inline-block; margin:0 12px;
  }

  /* ============== MECHANISM ============== */
  .section{padding:72px 0;}
  .section .h-eyebrow{
    text-align:center;
    color:var(--blue);
    font-family:'Caveat',cursive;
    font-size:22px;
    margin-bottom:6px;
  }
  .section h2{
    text-align:center;
    font-family:'Anton',sans-serif;
    font-size:64px;
    line-height:1;
    letter-spacing:-0.01em;
    margin-bottom:14px;
  }
  .section .h-sub{
    text-align:center;
    font-family:'DM Serif Display',serif;
    font-style:italic;
    font-size:22px;
    color:#1f2937;
    max-width:640px; margin:0 auto;
  }
  .section .h-sub .accent{color:var(--blue);}

  .mech-card{
    margin-top:42px;
    background:var(--blue-soft);
    border:1px solid var(--blue-line);
    border-radius:18px;
    padding:32px;
  }
  .mech-row{
    display:grid;
    grid-template-columns:1fr 0.4fr 1fr 0.4fr 1fr 0.4fr 1fr;
    align-items:center;
    gap:8px;
  }
  .mech-node{
    background:#fff; border:1.5px solid var(--blue-line);
    border-radius:14px; padding:18px 12px 14px;
    text-align:center;
    transition:transform .2s ease;
  }
  .mech-node:hover{transform:translateY(-3px);}
  .mech-node.final{background:var(--ink); border-color:var(--ink);}
  .mech-node.final .name{color:#fff;}
  .mech-node.final .sub{color:#9aa4b6;}
  .mech-node .icon{height:52px; display:flex; align-items:center; justify-content:center;}
  .mech-node .name{font-weight:900; font-size:14px; letter-spacing:0.10em; margin-top:6px;}
  .mech-node .sub{font-family:'Caveat',cursive; font-size:16px; color:var(--muted); margin-top:2px;}
  .mech-arrow{display:flex; align-items:center; justify-content:center;}
  .mech-loop{margin-top:14px; text-align:center;}
  .mech-loop-label{
    font-family:'Caveat',cursive; font-size:18px; color:var(--blue);
    margin-top:-2px;
  }

  /* ============== WHY ============== */
  .why .grid{
    margin-top:42px;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
  }
  .why-card{
    background:#fff; border:1px solid var(--blue-line);
    border-radius:14px; padding:26px;
    transition:transform .2s ease, box-shadow .2s ease;
  }
  .why-card:hover{transform:translateY(-3px); box-shadow:0 12px 30px rgba(11,42,107,.10);}
  .why-card .num{
    font-family:'Anton',sans-serif; font-size:36px;
    color:var(--blue); line-height:1;
  }
  .why-card h3{
    font-weight:900; font-size:17px; letter-spacing:0.04em;
    margin-top:6px;
  }
  .why-card p{
    margin-top:8px; font-size:14px; color:#1f2937;
  }
  .why-card p b{font-weight:800;}

  /* ============== PUNCHLINE ============== */
  .punch-section{padding:48px 0;}
  .punch{
    background:var(--ink); color:#fff;
    border-radius:18px;
    padding:48px 36px;
    text-align:center;
    font-family:'DM Serif Display',serif;
    font-style:italic;
    font-size:26px;
    line-height:1.4;
  }
  .punch .blue{color:#7aa3ff;}

  /* ============== CHAPTERS ============== */
  .chapters{background:var(--soft-bg);}
  .chapters .grid{
    margin-top:42px;
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    gap:14px;
  }
  .chapter-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:12px;
    padding:20px 22px;
    transition:transform .2s ease, border-color .2s ease;
  }
  .chapter-card:hover{transform:translateY(-3px); border-color:var(--blue-line);}
  .chapter-card .n{
    font-family:'Anton',sans-serif; font-size:22px;
    color:var(--blue); line-height:1;
  }
  .chapter-card .name{
    font-weight:900; font-size:14px; letter-spacing:0.06em;
    margin-top:4px;
  }
  .chapter-card p{
    font-size:12.5px; color:var(--muted); margin-top:8px; line-height:1.5;
  }

  /* ============== ABOUT ============== */
  .about{
    background:var(--blue-soft);
    text-align:center;
  }
  .about .inner{
    max-width:680px; margin:0 auto;
  }
  .about p.lead{
    font-family:'DM Serif Display',serif;
    font-style:italic;
    font-size:24px;
    line-height:1.4;
    margin-top:18px;
  }
  .about p.lead a{color:var(--blue);}
  .about .ig-pill{
    display:inline-flex; align-items:center; gap:8px;
    margin-top:24px;
    background:var(--ink); color:#fff;
    padding:12px 20px; border-radius:999px;
    font-weight:800; font-size:13px; letter-spacing:0.12em;
  }
  .about .ig-pill svg{width:16px; height:16px;}

  /* ============== FINAL CTA ============== */
  .final-cta{
    background:var(--deep-blue);
    color:#fff;
    text-align:center;
  }
  .final-cta h2{
    color:#fff;
    font-family:'Anton',sans-serif;
    font-size:62px;
    line-height:1;
    margin-bottom:14px;
  }
  .final-cta .h-sub{
    font-family:'DM Serif Display',serif;
    font-style:italic;
    font-size:20px;
    color:rgba(255,255,255,.85);
    max-width:540px;
    margin:0 auto 30px;
  }
  .final-cta form.capture{
    border-color:rgba(255,255,255,.2);
    background:rgba(255,255,255,.06);
  }
  .final-cta form.capture input[type=email]{color:#fff;}
  .final-cta form.capture input::placeholder{color:rgba(255,255,255,.5);}
  .final-cta .form-meta{color:rgba(255,255,255,.6);}
  .final-cta .form-meta b{color:#fff;}

  /* ============== FOOTER ============== */
  footer{
    padding:32px 0;
    border-top:1px solid var(--border);
    text-align:center;
    color:var(--muted);
    font-size:12px; letter-spacing:0.10em;
  }
  footer a{color:var(--blue); font-weight:700;}

  /* ============== RESPONSIVE ============== */
  @media (max-width:760px){
    h1.hero-title{font-size:30px;}
    h1 .display{font-size:72px;}
    .hero{padding:48px 0 36px;}
    .section{padding:56px 0;}
    .section h2{font-size:42px;}
    .section .h-sub{font-size:17px;}
    .mech-row{
      grid-template-columns:1fr;
      gap:14px;
    }
    .mech-arrow{transform:rotate(90deg); height:30px;}
    .mech-arrow svg{width:60px;}
    .why .grid, .chapters .grid{grid-template-columns:1fr;}
    .punch{font-size:19px; padding:32px 22px;}
    .final-cta h2{font-size:42px;}
    form.capture{flex-direction:column;}
    form.capture button{padding:14px;}
    nav.top .cta{display:none;}
  }
</style>
</head>
<body>

<!-- ============== NAV ============== -->
<nav class="top">
  <div class="inner">
    <div class="brand"><span class="at">@</span>SMMGUY</div>
    <a class="cta" href="#get">GET THE PLAYBOOK →</a>
  </div>
</nav>

<!-- ============== HERO ============== -->
<header class="hero" id="get">
  <div class="container">
    <div class="eyebrow"><span class="dot"></span>FREE 10-PAGE PLAYBOOK · 2026 EDITION</div>

    <h1 class="hero-title">
      The Founder-led Personal Brand
      <span class="display">PLAYBOOK</span>
    </h1>

    <p class="subhead">
      How founders build a personal brand in 2026 — and turn their face into <span class="accent">their business's cheapest distribution channel.</span> No fluff. No theory. The exact system.
    </p>

    <div class="form-wrap">
      <?php if ($success): ?>
        <div class="success-card">
          <div class="check">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M5 12.5l4.5 4.5L19 7" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <h3>You're in.</h3>
          <p>The playbook is yours. Tap below to download instantly.</p>
          <a class="download" href="playbook.pdf" download>DOWNLOAD THE PLAYBOOK ↓</a>
        </div>
      <?php else: ?>
        <form class="capture" method="POST" action="#get">
          <input type="email" name="email" placeholder="your@email.com" value="<?= htmlspecialchars($email) ?>" required>
          <button type="submit">SEND IT TO ME →</button>
        </form>
        <?php if ($error): ?>
          <div class="err"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <div class="form-meta"><b>Instant download.</b> No spam. Unsubscribe anytime.</div>
      <?php endif; ?>
    </div>

    <div class="trust-row">
      <span>NO FLUFF</span><span class="pip"></span>
      <span>NO THEORY</span><span class="pip"></span>
      <span>BUILT FOR FOUNDERS</span>
    </div>
  </div>
</header>

<!-- ============== MECHANISM ============== -->
<section class="section" id="mechanism">
  <div class="container">
    <div class="h-eyebrow">the whole thesis in one diagram</div>
    <h2>THE MECHANISM</h2>
    <div class="h-sub">Your face turns <span class="accent">on</span>. The compounding turns <span class="accent">on</span>.</div>

    <div class="mech-card">
      <div class="mech-row">
        <div class="mech-node">
          <div class="icon">
            <svg viewBox="0 0 40 40" width="40" height="40"><circle cx="20" cy="14" r="7" fill="none" stroke="#1d4ed8" stroke-width="2.2"/><path d="M7 34c2-7 8-10 13-10s11 3 13 10" fill="none" stroke="#1d4ed8" stroke-width="2.2" stroke-linecap="round"/></svg>
          </div>
          <div class="name">YOU</div>
          <div class="sub">the founder</div>
        </div>
        <div class="mech-arrow">
          <svg viewBox="0 0 80 14" width="80" height="14"><line x1="0" y1="7" x2="72" y2="7" stroke="#1d4ed8" stroke-width="1.5" stroke-dasharray="4 4"/><polyline points="66,2 74,7 66,12" fill="none" stroke="#1d4ed8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div class="mech-node">
          <div class="icon">
            <svg viewBox="0 0 40 40" width="40" height="40"><rect x="6" y="11" width="22" height="18" rx="2.5" fill="none" stroke="#1d4ed8" stroke-width="2.2"/><polygon points="28,17 36,12 36,28 28,23" fill="#1d4ed8"/><circle cx="13" cy="20" r="2.2" fill="#1d4ed8"/></svg>
          </div>
          <div class="name">CONTENT</div>
          <div class="sub">your face, daily</div>
        </div>
        <div class="mech-arrow">
          <svg viewBox="0 0 80 14" width="80" height="14"><line x1="0" y1="7" x2="72" y2="7" stroke="#1d4ed8" stroke-width="1.5" stroke-dasharray="4 4"/><polyline points="66,2 74,7 66,12" fill="none" stroke="#1d4ed8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div class="mech-node">
          <div class="icon">
            <svg viewBox="0 0 40 40" width="40" height="40"><circle cx="13" cy="15" r="5" fill="none" stroke="#1d4ed8" stroke-width="2.2"/><circle cx="27" cy="15" r="5" fill="none" stroke="#1d4ed8" stroke-width="2.2"/><circle cx="20" cy="13" r="5" fill="#1d4ed8"/><path d="M3 33c1.5-5 5-7.5 10-7.5s8.5 2.5 10 7.5" fill="none" stroke="#1d4ed8" stroke-width="2.2" stroke-linecap="round"/><path d="M17 33c1.5-5 5-7.5 10-7.5s8.5 2.5 10 7.5" fill="none" stroke="#1d4ed8" stroke-width="2.2" stroke-linecap="round"/></svg>
          </div>
          <div class="name">AUDIENCE</div>
          <div class="sub">trust compounds</div>
        </div>
        <div class="mech-arrow">
          <svg viewBox="0 0 80 14" width="80" height="14"><line x1="0" y1="7" x2="72" y2="7" stroke="#1d4ed8" stroke-width="1.5" stroke-dasharray="4 4"/><polyline points="66,2 74,7 66,12" fill="none" stroke="#1d4ed8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div class="mech-node final">
          <div class="icon">
            <svg viewBox="0 0 40 40" width="40" height="40"><polyline points="6,30 16,20 22,25 34,10" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/><polyline points="28,10 34,10 34,16" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="name">BUSINESS</div>
          <div class="sub">inbound revenue</div>
        </div>
      </div>
      <div class="mech-loop">
        <div class="mech-loop-label">↻ compounds back into <b>more content fuel</b></div>
      </div>
    </div>
  </div>
</section>

<!-- ============== WHY NOW ============== -->
<section class="section why" id="why">
  <div class="container">
    <div class="h-eyebrow">why now, not later</div>
    <h2>DISTRIBUTION IS<br>THE NEW MOAT.</h2>
    <div class="h-sub">Four shifts that make 2026 the most expensive year to be invisible.</div>

    <div class="grid">
      <div class="why-card">
        <div class="num">01</div>
        <h3>AI BROKE "EXPERTISE" AS A MOAT.</h3>
        <p>Anyone can spin up a clone of your service in a weekend. The only thing AI cannot copy is <b>you, on camera, building in public.</b> Your face is now a defensible asset — your skills are not.</p>
      </div>
      <div class="why-card">
        <div class="num">02</div>
        <h3>PAID IS THE MOST EXPENSIVE IT'S EVER BEEN.</h3>
        <p>CPMs are up 4x in 3 years. The founders winning are the ones whose audience already trusts them <b>before the ad ever runs.</b> Personal brand is the cheapest CAC line on your P&amp;L.</p>
      </div>
      <div class="why-card">
        <div class="num">03</div>
        <h3>INBOUND BEATS OUTBOUND, ALWAYS.</h3>
        <p>One founder with 5K real followers gets more qualified inbound in a week than a 5-person SDR team in a month. Inbound clients close 3x faster and pay 2x more.</p>
      </div>
      <div class="why-card">
        <div class="num">04</div>
        <h3>TRUST TRANSFERS TO PRICE.</h3>
        <p>People will pay <b>3-5x more</b> to work with someone they already follow. Personal brand is a margin lever, not a vanity project.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============== PUNCHLINE ============== -->
<section class="punch-section">
  <div class="container">
    <div class="punch">
      In 2026, the founders without a face will <span class="blue">pay strangers to find them.</span><br>
      The founders with one will be <span class="blue">paid by strangers to find them.</span>
    </div>
  </div>
</section>

<!-- ============== CHAPTERS ============== -->
<section class="section chapters" id="chapters">
  <div class="container">
    <div class="h-eyebrow">the full table of contents</div>
    <h2>WHAT'S INSIDE.</h2>
    <div class="h-sub">A founder's full operating system — from positioning to your first $30K of inbound.</div>

    <div class="grid">
      <div class="chapter-card"><div class="n">01</div><div class="name">THE 2026 THESIS</div><p>Why distribution is the new moat — and why your face is the cheapest channel you'll ever own.</p></div>
      <div class="chapter-card"><div class="n">02</div><div class="name">POSITIONING</div><p>Pick a belief, not a niche. The exact founder positioning statement + 4 self-tests.</p></div>
      <div class="chapter-card"><div class="n">03</div><div class="name">IDEATION</div><p>The 5 buckets every idea comes from + where to capture them daily so you never run dry.</p></div>
      <div class="chapter-card"><div class="n">04</div><div class="name">SCRIPTING</div><p>Hook → Tension → Payoff. The 3-part framework + 3 hook formulas that never miss.</p></div>
      <div class="chapter-card"><div class="n">05</div><div class="name">FILMING + EDITING</div><p>The phone-only setup, the 80/20 of editing, and the 30-min rule founders break.</p></div>
      <div class="chapter-card"><div class="n">06</div><div class="name">DISTRIBUTION</div><p>The 5·3·1 weekly rhythm + the 4 distribution rules nobody actually follows.</p></div>
      <div class="chapter-card"><div class="n">07</div><div class="name">CLONE YOURSELF</div><p>The 4 roles to clone (in order) — and the non-negotiable rule that keeps your voice yours.</p></div>
      <div class="chapter-card"><div class="n">08</div><div class="name">THE FUNNEL</div><p>The 4-layer funnel + the 6-second profile test + the DM funnel that actually prints.</p></div>
      <div class="chapter-card"><div class="n">09</div><div class="name">0 → 10K · 90 DAYS</div><p>The 12-week system, week-by-week, with a daily 60-min founder stack to hit 10K + your first $30K.</p></div>
    </div>
  </div>
</section>

<!-- ============== ABOUT ============== -->
<section class="section about">
  <div class="container">
    <div class="inner">
      <div class="h-eyebrow">who built this</div>
      <h2 style="color:var(--ink);">@SMMGUY</h2>
      <p class="lead">
        Founder content systems for founders who'd rather <span style="color:var(--blue);">build than post</span> — written by someone who's done both.
      </p>
      <a class="ig-pill" href="https://instagram.com/smmguy" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="#fff"/></svg>
        FOLLOW @SMMGUY
      </a>
    </div>
  </div>
</section>

<!-- ============== FINAL CTA ============== -->
<section class="section final-cta" id="get-bottom">
  <div class="container">
    <div class="h-eyebrow" style="color:#7aa3ff;">last call</div>
    <h2>GET THE PLAYBOOK.</h2>
    <div class="h-sub">The exact system to build a founder-led brand in 2026.</div>

    <div class="form-wrap">
      <?php if ($success): ?>
        <div class="success-card" style="background:#fff; color:var(--ink);">
          <div class="check">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M5 12.5l4.5 4.5L19 7" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <h3 style="color:var(--ink);">You're in.</h3>
          <p style="color:var(--muted);">The playbook is yours. Tap below.</p>
          <a class="download" href="playbook.pdf" download>DOWNLOAD THE PLAYBOOK ↓</a>
        </div>
      <?php else: ?>
        <form class="capture" method="POST" action="#get-bottom">
          <input type="email" name="email" placeholder="your@email.com" required>
          <button type="submit">SEND IT TO ME →</button>
        </form>
        <div class="form-meta"><b style="color:#fff;">Instant download.</b> No spam. Unsubscribe anytime.</div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ============== FOOTER ============== -->
<footer>
  © <?= date('Y') ?> · BUILT BY <a href="https://instagram.com/smmguy" target="_blank" rel="noopener">@SMMGUY</a>
</footer>

</body>
</html>
