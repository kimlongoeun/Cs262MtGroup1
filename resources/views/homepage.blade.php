@extends('layout')
@section('title', 'STEM Cambodia - Home')
@section('content')

    <style>
        /* ── SHARED ── */
        .label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: var(--mono);
            font-size: 11px;
            font-weight: 500;
            color: var(--blue);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: .75rem;
        }

        .label::before {
            content: '';
            width: 16px;
            height: 1px;
            background: var(--blue);
            display: inline-block;
        }

        .h2 {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 600;
            color: var(--text);
            line-height: 1.2;
            letter-spacing: -0.02em;
            margin-bottom: .85rem;
        }

        .h2 em {
            font-style: normal;
            color: var(--blue);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13.5px;
            font-weight: 500;
            color: #fff;
            background: var(--blue);
            text-decoration: none;
            padding: 9px 20px;
            border-radius: var(--r);
            transition: opacity .15s;
        }

        .btn-primary:hover {
            opacity: .85;
            color: #fff;
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13.5px;
            font-weight: 400;
            color: var(--text-2);
            text-decoration: none;
            padding: 9px 18px;
            border-radius: var(--r);
            border: 1px solid var(--border-md);
            transition: border-color .15s, color .15s;
        }

        .btn-ghost:hover {
            color: var(--text);
            border-color: #9098a3;
        }

        .section {
            padding: 5rem 2rem;
        }

        .section-inner {
            max-width: var(--max-w);
            margin: 0 auto;
        }

        .section-soft {
            background: var(--bg-soft);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        /* ── HERO ── */
        .hero {
            padding: 6rem 2rem 5rem;
            background: var(--bg);
            border-bottom: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .hero-inner {
            max-width: var(--max-w);
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 4rem;
            align-items: center;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: var(--mono);
            font-size: 11px;
            color: var(--blue);
            background: var(--blue-lt);
            border: 1px solid #c7d9f8;
            padding: 4px 12px;
            border-radius: 100px;
            letter-spacing: 0.06em;
            margin-bottom: 1.5rem;
            opacity: 0;
            animation: up .5s .05s forwards;
        }

        .hero-h1 {
            font-size: clamp(2.2rem, 4.5vw, 3.4rem);
            font-weight: 600;
            line-height: 1.1;
            letter-spacing: -0.03em;
            color: var(--text);
            margin-bottom: 1.25rem;
            opacity: 0;
            animation: up .5s .15s forwards;
        }

        .hero-h1 .blue {
            color: var(--blue);
        }

        .hero-sub {
            font-size: 15.5px;
            color: var(--text-2);
            line-height: 1.75;
            max-width: 480px;
            margin-bottom: 2rem;
            opacity: 0;
            animation: up .5s .25s forwards;
        }

        .hero-ctas {
            display: flex;
            gap: .75rem;
            flex-wrap: wrap;
            opacity: 0;
            animation: up .5s .35s forwards;
        }

        .hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
            opacity: 0;
            animation: up .5s .45s forwards;
        }

        .h-stat-val {
            font-family: var(--mono);
            font-size: 1.5rem;
            font-weight: 500;
            color: var(--text);
            line-height: 1;
            margin-bottom: 4px;
        }

        .h-stat-val b {
            color: var(--blue);
            font-weight: 500;
        }

        .h-stat-lbl {
            font-size: 12px;
            color: var(--text-3);
        }

        /* Hero visual */
        .hero-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            animation: fade .8s .5s forwards;
        }

        .hero-visual-box {
            width: 340px;
            height: 340px;
            background: transparent;
            border: none;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-visual-box::before {
            display: none;
        }

        .hero-visual-box img {
            width: 200px;
            height: 200px;
            object-fit: contain;
            position: relative;
            z-index: 1;
            animation: floatY 4s ease-in-out infinite;
        }

        /* ── TICKER ── */
        .ticker {
            height: 38px;
            background: var(--blue);
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .ticker-label {
            flex-shrink: 0;
            font-family: var(--mono);
            font-size: 10px;
            font-weight: 500;
            color: rgba(255, 255, 255, .7);
            padding: 0 1.25rem;
            border-right: 1px solid rgba(255, 255, 255, .2);
            height: 100%;
            display: flex;
            align-items: center;
            letter-spacing: .12em;
        }

        .ticker-scroll {
            overflow: hidden;
            flex: 1;
        }

        .ticker-track {
            display: flex;
            gap: 3rem;
            white-space: nowrap;
            animation: ticker 30s linear infinite;
            padding-left: 2rem;
        }

        .ticker-item {
            font-size: 12px;
            color: rgba(255, 255, 255, .9);
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 400;
        }

        .ticker-item::before {
            content: '·';
            font-size: 18px;
            opacity: .6;
        }

        /* ── STATS BAR ── */
        .stats-bar {
            background: var(--bg);
            border-bottom: 1px solid var(--border);
        }

        .stats-bar-inner {
            max-width: var(--max-w);
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .stat-cell {
            padding: 2rem 1.75rem;
            border-right: 1px solid var(--border);
        }

        .stat-cell:last-child {
            border-right: none;
        }

        .stat-num {
            font-family: var(--mono);
            font-size: 2rem;
            font-weight: 500;
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-num.blue {
            color: var(--blue);
        }

        .stat-num.green {
            color: var(--green);
        }

        .stat-num.amber {
            color: var(--amber);
        }

        .stat-num.purple {
            color: var(--purple);
        }

        .stat-desc {
            font-size: 13px;
            color: var(--text-2);
            margin-bottom: 4px;
        }

        .stat-note {
            font-family: var(--mono);
            font-size: 10px;
            color: var(--text-3);
            letter-spacing: .04em;
        }

        /* ── SUBJECTS ── */
        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 2rem;
        }

        .subj-card {
            background: var(--bg);
            padding: 1.75rem 1.5rem 2rem;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            position: relative;
            transition: background .2s;
        }

        .subj-card:hover {
            background: var(--bg-soft);
        }

        .subj-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .25s;
        }

        .subj-card:hover::after {
            transform: scaleX(1);
        }

        .subj-card.s-sci::after {
            background: var(--green);
        }

        .subj-card.s-tech::after {
            background: var(--blue);
        }

        .subj-card.s-eng::after {
            background: var(--amber);
        }

        .subj-card.s-math::after {
            background: var(--purple);
        }

        .subj-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .s-sci .subj-icon {
            background: var(--green-lt);
            color: var(--green);
        }

        .s-tech .subj-icon {
            background: var(--blue-lt);
            color: var(--blue);
        }

        .s-eng .subj-icon {
            background: var(--amber-lt);
            color: var(--amber);
        }

        .s-math .subj-icon {
            background: var(--purple-lt);
            color: var(--purple);
        }

        .subj-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 4px;
        }

        .subj-desc {
            font-size: 12.5px;
            color: var(--text-2);
            line-height: 1.6;
            flex: 1;
        }

        .subj-link {
            font-size: 12px;
            color: var(--text-3);
            margin-top: auto;
            transition: color .15s;
        }

        .subj-card:hover .subj-link {
            color: var(--text-2);
        }

        /* ── WHY ── */
        .why-inner {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 5rem;
            align-items: start;
        }

        .why-sticky {
            position: sticky;
            top: calc(var(--nav-h) + 2rem);
        }

        .why-sticky p {
            font-size: 14px;
            color: var(--text-2);
            line-height: 1.75;
            margin-top: .6rem;
        }

        .why-item {
            display: grid;
            grid-template-columns: 32px 1fr;
            gap: 1.25rem;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border);
        }

        .why-item:first-child {
            border-top: 1px solid var(--border);
        }

        .why-n {
            font-family: var(--mono);
            font-size: 11px;
            color: var(--text-3);
            padding-top: 2px;
        }

        .why-item h3 {
            font-size: 15px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: .4rem;
        }

        .why-item p {
            font-size: 13.5px;
            color: var(--text-2);
            line-height: 1.7;
        }

        .tag {
            display: inline-block;
            margin-top: .5rem;
            font-size: 10.5px;
            color: var(--blue);
            background: var(--blue-lt);
            border: 1px solid #c7d9f8;
            padding: 2px 8px;
            border-radius: 100px;
            letter-spacing: .04em;
        }

        /* ── PROGRAMS ── */
        .programs-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .prog-card {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1.5rem;
            transition: border-color .2s, transform .2s;
        }

        .prog-card:hover {
            border-color: var(--border-md);
            transform: translateY(-2px);
        }

        .prog-badge {
            font-family: var(--mono);
            font-size: 10px;
            font-weight: 500;
            color: var(--blue);
            letter-spacing: .1em;
            text-transform: uppercase;
            margin-bottom: .75rem;
        }

        .prog-card h3 {
            font-size: 15px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: .5rem;
        }

        .prog-card p {
            font-size: 13px;
            color: var(--text-2);
            line-height: 1.7;
        }

        .prog-meta {
            display: flex;
            gap: .75rem;
            flex-wrap: wrap;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--border);
        }

        .prog-meta-item {
            font-size: 11px;
            color: var(--text-3);
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .prog-meta-item strong {
            font-size: 12.5px;
            color: var(--text-2);
            font-weight: 500;
        }

        /* ── CTA ── */
        .cta-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .cta-panel {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 2rem;
        }

        .cta-panel-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .live-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--green);
            animation: pulse 2s infinite;
        }

        .cta-list {
            list-style: none;
        }

        .cta-list li {
            font-size: 13.5px;
            color: var(--text-2);
            padding: .75rem 0;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cta-list li:last-child {
            border-bottom: none;
        }

        .val {
            font-family: var(--mono);
            font-size: 12px;
            color: var(--blue);
            font-weight: 500;
        }

        .cta-text p {
            font-size: 15px;
            color: var(--text-2);
            line-height: 1.75;
            margin-bottom: 1.5rem;
        }

        .checklist {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .5rem;
            margin-bottom: 1.75rem;
        }

        .checklist li {
            font-size: 13.5px;
            color: var(--text-2);
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .checklist li::before {
            content: '✓';
            font-family: var(--mono);
            font-size: 11px;
            color: var(--green);
            font-weight: 500;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* ── PARTNERS ── */
        .partners-inner {
            max-width: var(--max-w);
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .partners-lbl {
            font-size: 11px;
            color: var(--text-3);
            font-family: var(--mono);
            letter-spacing: .1em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .partners-div {
            width: 1px;
            height: 28px;
            background: var(--border);
            flex-shrink: 0;
        }

        .partners-row {
            display: flex;
            gap: 1.75rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .partner-item {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-3);
            letter-spacing: .04em;
            transition: color .15s;
        }

        .partner-item:hover {
            color: var(--text-2);
        }

        /* ── KEYFRAMES ── */
        @keyframes up {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes ticker {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .35;
            }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {

            .hero-inner,
            .why-inner,
            .cta-inner {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .subjects-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-bar-inner {
                grid-template-columns: repeat(2, 1fr);
            }

            .programs-grid {
                grid-template-columns: 1fr;
            }

            .why-sticky {
                position: static;
            }

            .hero-visual {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .subjects-grid {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1.25rem;
            }

            .section {
                padding: 3.5rem 1.25rem;
            }
        }
    </style>



    <!-- ══ HERO ══ -->
    <section class="hero"
        style="
    background-image: url('https://stemcambodia.ngo/wp-content/uploads/2025/06/STEM-Group-scaled-e1750055818707.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
">
        {{-- Dark overlay so text stays readable --}}
        <div
            style="
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to right,
                rgba(5, 15, 35, 0.82) 0%,
                rgba(5, 15, 35, 0.55) 60%,
            rgba(5, 15, 35, 0.25) 100%
        );
        z-index: 0;
    ">
        </div>

        <div class="hero-inner" style="position: relative; z-index: 1;">
            <div>
                <div class="hero-eyebrow"
                    style="color: #a8c8ff; border-color: rgba(168,200,255,0.35); background: rgba(168,200,255,0.12);">
                    Cambodia's leading STEM platform
                </div>

                <h1 class="hero-h1" style="color: #ffffff;">
                    Advancing Cambodia<br>through <span class="blue" style="color: #60a5fa;">STEM education</span>
                </h1>

                <p class="hero-sub" style="color: rgba(255,255,255,0.78);">
                    STEMBODIAN equips Cambodian students with critical skills through high-impact educational programs —
                    driving sustainable progress across science, technology, engineering, and mathematics.
                </p>

                <div class="hero-ctas">
                    <a href="/dashboard" class="btn-primary">Start learning →</a>
                </div>

                <div class="hero-stats" style="border-top-color: rgba(255,255,255,0.15);">
                    <div>
                        <div class="h-stat-val" style="color: #ffffff;">12<b style="color: #60a5fa;">K+</b></div>
                        <div class="h-stat-lbl" style="color: rgba(255,255,255,0.55);">Students enrolled</div>
                    </div>
                    <div>
                        <div class="h-stat-val" style="color: #ffffff;">4</div>
                        <div class="h-stat-lbl" style="color: rgba(255,255,255,0.55);">STEM disciplines</div>
                    </div>
                    <div>
                        <div class="h-stat-val" style="color: #ffffff;">98<b style="color: #60a5fa;">%</b></div>
                        <div class="h-stat-lbl" style="color: rgba(255,255,255,0.55);">Satisfaction rate</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-visual-box"
                    style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); backdrop-filter: blur(8px);">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/STEM-Mark.png" alt="STEM Cambodia">
                </div>
            </div>
        </div>
    </section>

    <!-- ══ SUBJECTS ══ -->
    <section class="section">
        <div class="section-inner">
            <div style="display:flex; justify-content:space-between; align-items:flex-end;">
                <div>
                    <span class="label">Explore</span>
                    <h2 class="h2">Four pillars of <em>STEM</em></h2>
                </div>
                <a href="/dashboard" class="btn-ghost" style="font-size:13px;">View all →</a>
            </div>

            <div class="subjects-grid">
                <a class="subj-card s-sci" href="/science">
                    <div class="subj-icon">
                        <span class="material-symbols-outlined">science</span>
                    </div>
                    <div>
                        <div class="subj-title">Science</div>
                        <p class="subj-desc">Biology, chemistry, physics, and earth science through experiments and
                            real-world phenomena.</p>
                    </div>
                    <span class="subj-link">Explore Science →</span>
                </a>
                <a class="subj-card s-tech" href="/technology">
                    <div class="subj-icon">
                        <span class="material-symbols-outlined">devices</span>
                    </div>
                    <div>
                        <div class="subj-title">Technology</div>
                        <p class="subj-desc">Programming, AI, data science, and digital literacy for the modern tech-driven
                            economy.</p>
                    </div>
                    <span class="subj-link">Explore Technology →</span>
                </a>
                <a class="subj-card s-eng" href="/engineering">
                    <div class="subj-icon">
                        <span class="material-symbols-outlined">precision_manufacturing</span>
                    </div>
                    <div>
                        <div class="subj-title">Engineering</div>
                        <p class="subj-desc">Design, build, and test. From civil structures to robotics — apply science to
                            solve real problems.</p>
                    </div>
                    <span class="subj-link">Explore Engineering →</span>
                </a>
                <a class="subj-card s-math" href="/mathematics">
                    <div class="subj-icon">
                        <span class="material-symbols-outlined">calculate</span>
                    </div>
                    <div>
                        <div class="subj-title">Mathematics</div>
                        <p class="subj-desc">Algebra, geometry, calculus, and statistics — the universal language of all
                            STEM disciplines.</p>
                    </div>
                    <span class="subj-link">Explore Mathematics →</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ══ WHY STEM ══ -->
    <section class="section section-soft">
        <div class="section-inner">
            <div class="why-inner">
                <div class="why-sticky">
                    <span class="label">Why it matters</span>
                    <h2 class="h2">Why choose <em>STEM?</em></h2>
                    <p>STEM disciplines are the backbone of Cambodia's fastest-growing industries — from digital banking to
                        agritech.</p>
                </div>
                <div>
                    <div class="why-item">
                        <div class="why-n">01</div>
                        <div>
                            <h3>Critical thinking</h3>
                            <p>Break down complex problems, evaluate evidence, and arrive at logical conclusions — skills
                                valued in every career and life situation.</p>
                            <span class="tag">Problem solving</span>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-n">02</div>
                        <div>
                            <h3>Future-ready careers</h3>
                            <p>By 2030, over 85% of the fastest-growing jobs in Southeast Asia will require STEM
                                competencies.</p>
                            <span class="tag">Career growth</span>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-n">03</div>
                        <div>
                            <h3>Innovation engine</h3>
                            <p>Build better technology, sustainable agriculture, clean energy solutions, and world-class
                                software — rooted in Cambodian context.</p>
                            <span class="tag">Tech innovation</span>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-n">04</div>
                        <div>
                            <h3>National development</h3>
                            <p>Cambodia's Vision 2050 relies on a tech-literate workforce. STEM is a direct investment in
                                the country's digital transformation.</p>
                            <span class="tag">Cambodia 2050</span>
                        </div>
                    </div>
                    <div class="why-item">
                        <div class="why-n">05</div>
                        <div>
                            <h3>Collaborative mindset</h3>
                            <p>Science and engineering are team sports. STEM builds communication, teamwork, and
                                cross-disciplinary skills modern workplaces demand.</p>
                            <span class="tag">Teamwork</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ PROGRAMS ══ -->
    <section class="section">
        <div class="section-inner">
            <span class="label">Community</span>
            <h2 class="h2">What we <em>offer</em></h2>

            <div class="programs-grid">

                <div class="prog-card">
                    <div class="prog-badge">Networking</div>
                    <h3>Tech community meetups</h3>
                    <p>Connect with developers, designers, entrepreneurs, and tech enthusiasts through regular networking
                        events, knowledge-sharing sessions, and community gatherings across Cambodia.</p>

                    <div class="prog-meta">
                        <div class="prog-meta-item"><span>Audience</span><strong>All Levels</strong></div>
                        <div class="prog-meta-item"><span>Format</span><strong>Hybrid</strong></div>
                        <div class="prog-meta-item"><span>Schedule</span><strong>Monthly</strong></div>
                    </div>
                </div>

                <div class="prog-card">
                    <div class="prog-badge">Events</div>
                    <h3>Workshops & hackathons</h3>
                    <p>Participate in hands-on coding workshops, startup challenges, hackathons, and collaborative projects
                        designed to strengthen practical skills and encourage innovation.</p>

                    <div class="prog-meta">
                        <div class="prog-meta-item"><span>Frequency</span><strong>Regular</strong></div>
                        <div class="prog-meta-item"><span>Mode</span><strong>In-person</strong></div>
                        <div class="prog-meta-item"><span>Focus</span><strong>Tech & Innovation</strong></div>
                    </div>
                </div>

                <div class="prog-card">
                    <div class="prog-badge">Resources</div>
                    <h3>Learning & career growth</h3>
                    <p>Access curated learning resources, mentorship opportunities, career guidance, job postings, and
                        industry insights to support your journey in Cambodia's growing tech ecosystem.</p>

                    <div class="prog-meta">
                        <div class="prog-meta-item"><span>Access</span><strong>Open</strong></div>
                        <div class="prog-meta-item"><span>Language</span><strong>KH / EN</strong></div>
                        <div class="prog-meta-item"><span>Support</span><strong>Mentorship</strong></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ══ SPONSORS ══ -->
    <section class="sponsors">
        <style>
            .sponsors {
                padding: 4rem 2rem;
                border-top: 1px solid var(--border);
                border-bottom: 1px solid var(--border);
                background: var(--bg-soft);
            }

            .sponsors-inner {
                max-width: var(--max-w);
                margin: 0 auto;
            }

            .sponsors-inner>.label {
                display: block;
                margin-bottom: .5rem;
            }

            .sponsors-inner>.h2 {
                margin-bottom: 2.5rem;
            }

            .sponsors-grid {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                gap: 2.5rem 3rem;
            }

            .sponsor-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: .6rem;
            }

            .sponsor-item img {
                height: 72px;
                width: auto;
                max-width: 140px;
                object-fit: contain;
                filter: grayscale(20%);
                opacity: .85;
                transition: opacity .2s, filter .2s;
            }

            .sponsor-item:hover img {
                opacity: 1;
                filter: grayscale(0%);
            }

            .sponsor-item span {
                font-size: 10.5px;
                color: var(--text-3);
                text-align: center;
                font-family: var(--mono);
                letter-spacing: .04em;
                text-transform: uppercase;
            }
        </style>

        <div class="sponsors-inner">

            <span class="label">Sponsors</span>
            <h2 class="h2">Supported by our <em>partners</em></h2>

            <div class="sponsors-grid">

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/MOEYS-2-254x300.png"
                        alt="Ministry of Education Youth and Sport">
                    <span>Ministry of Education<br>Youth and Sport</span>
                </div>

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/MOE-1-253x300.png"
                        alt="Ministry of Environment">
                    <span>Ministry of Environment</span>
                </div>

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/PTC.png" alt="PTC">
                    <span>P.T.C</span>
                </div>

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/MISTI.png"
                        alt="Ministry of Industry Science Technology and Innovation">
                    <span>Ministry of Industry,<br>Science & Innovation</span>
                </div>

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/cropped-logo-300x300.png"
                        alt="RUPP">
                    <span>RUPP</span>
                </div>

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/British-Embassy-1024x840.png"
                        alt="British Embassy Phnom Penh">
                    <span>British Embassy<br>Phnom Penh</span>
                </div>

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/Untitled-design-8.png" alt="WCS">
                    <span>WCS</span>
                </div>

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/Logo1-04.png" alt="Kilat Events">
                    <span>Kilat Events</span>
                </div>

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/Smart-Logo-768x501.png"
                        alt="Smart Axiata">
                    <span>Smart Axiata</span>
                </div>

                <div class="sponsor-item">
                    <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/Logo-1024x346.jpg"
                        alt="AEON Mall Mean Chey">
                    <span>AEON MALL<br>Mean Chey</span>
                </div>

            </div>

        </div>
    </section>

    <!-- ══ PARTNERS ══ -->
    <section style="padding: 2.5rem 2rem; border-top: 1px solid var(--border);">
        <div class="partners-inner">
            <div class="partners-lbl">Trusted by</div>
            <div class="partners-div"></div>
            <div class="partners-row">
                <span class="partner-item">Ministry of Education</span>
                <span class="partner-item">RUPP</span>
                <span class="partner-item">IFL</span>
                <span class="partner-item">USAID</span>
                <span class="partner-item">UNESCO</span>
                <span class="partner-item">Smart Axiata</span>
            </div>
        </div>
    </section>

@endsection
