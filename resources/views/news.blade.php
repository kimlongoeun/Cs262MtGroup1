@extends('layout')
@section('title', 'STEM Cambodia - News')
@section('content')

    <style>
        .page-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 3rem 1.5rem 5rem;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            margin-bottom: 2.5rem;
        }

        .page-eyebrow {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--clr-muted);
            margin-bottom: 0.4rem;
        }

        .page-title {
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--clr-text);
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .filter-btn {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--clr-muted);
            background: var(--clr-surface);
            border: 1px solid var(--clr-border);
            border-radius: 100px;
            padding: 0.3rem 0.9rem;
            cursor: pointer;
            transition: all 0.15s;
            text-decoration: none;
        }

        .filter-btn:hover,
        .filter-btn.active {
            color: var(--clr-accent);
            border-color: var(--clr-accent);
            background: var(--clr-accent-dim);
        }

        /* ── FEATURED ARTICLE ── */
        .featured-article {
            background: var(--clr-surface);
            border: 1px solid var(--clr-border);
            border-radius: var(--radius);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 420px;
            margin-bottom: 2rem;
            transition: box-shadow 0.2s;
        }

        .featured-article:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
        }

        @media (max-width: 780px) {
            .featured-article {
                grid-template-columns: 1fr;
            }
        }

        .featured-img {
            background: linear-gradient(135deg, #e8f5ee 0%, #dbeafe 100%);
            min-height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
            order: 2;
        }

        @media (max-width: 780px) {
            .featured-img {
                min-height: 180px;
                order: 0;
            }
        }

        .featured-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0.75rem;
        }

        .article-tag {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--clr-accent);
            font-weight: 500;
        }

        .article-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--clr-text);
            line-height: 1.35;
            text-decoration: none;
        }

        .article-title:hover {
            color: var(--clr-accent);
        }

        .article-excerpt {
            font-size: 14px;
            color: var(--clr-muted);
            line-height: 1.6;
        }

        .article-meta {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--clr-muted);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 13px;
            font-weight: 500;
            color: var(--clr-accent);
            text-decoration: none;
            margin-top: 0.25rem;
            width: fit-content;
        }

        .read-more:hover {
            text-decoration: underline;
        }

        /* ── NEWS GRID ── */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }

        @media (max-width: 900px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 560px) {
            .news-grid {
                grid-template-columns: 1fr;
            }
        }

        .news-card {
            background: var(--clr-surface);
            border: 1px solid var(--clr-border);
            border-radius: var(--radius);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s, transform 0.2s;
            text-decoration: none;
        }

        .news-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            transform: translateY(-2px);
        }

        .news-card-thumb {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .thumb-science {
            background: linear-gradient(135deg, #e8f5ee, #d1fae5);
        }

        .thumb-tech {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
        }

        .thumb-eng {
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        }

        .thumb-math {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
        }

        .thumb-env {
            background: linear-gradient(135deg, #ecfdf5, #a7f3d0);
        }

        .thumb-health {
            background: linear-gradient(135deg, #fdf2f8, #f5d0fe);
        }

        .news-card-body {
            padding: 1.1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .news-card-tag {
            font-family: 'DM Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--clr-accent);
        }

        .news-card-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--clr-text);
            line-height: 1.4;
            flex: 1;
        }

        .news-card-meta {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--clr-muted);
            margin-top: 0.5rem;
        }

        /* ── SECTION LABEL ── */
        .section-label {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--clr-muted);
            margin-bottom: 1rem;
        }

        .section-gap {
            margin-top: 2.5rem;
        }

        /* ── NEWSLETTER ── */
        .newsletter-bar {
            background: var(--clr-accent);
            border-radius: var(--radius);
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 3rem;
        }

        .newsletter-text h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.2rem;
        }

        .newsletter-text p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.75);
        }

        .newsletter-form {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .newsletter-input {
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            padding: 0.5rem 1rem;
            color: #fff;
            outline: none;
            min-width: 220px;
        }

        .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.55);
        }

        .newsletter-btn {
            font-size: 13px;
            font-weight: 500;
            background: #fff;
            color: var(--clr-accent);
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1.1rem;
            cursor: pointer;
            transition: opacity 0.15s;
        }

        .newsletter-btn:hover {
            opacity: 0.9;
        }
    </style>

    <div class="page-wrap">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <p class="page-eyebrow">Latest updates</p>
            <h1 class="page-title">News &amp; Articles</h1>
        </div>

        <!-- FILTER BAR -->
        <div class="filter-bar">
            <a class="filter-btn active" href="#">All</a>
            <a class="filter-btn" href="#">Science</a>
            <a class="filter-btn" href="#">Technology</a>
            <a class="filter-btn" href="#">Engineering</a>
            <a class="filter-btn" href="#">Mathematics</a>
            <a class="filter-btn" href="#">Environment</a>
            <a class="filter-btn" href="#">Health</a>
        </div>

<!-- FEATURED ARTICLE -->
<a class="featured-article" href="#">
    <div class="featured-body">
        <span class="article-tag">Featured · Science</span>
        <span class="article-title">Cambodia Launches First National STEM Curriculum for Secondary Schools</span>
        <p class="article-excerpt">The Ministry of Education, Youth and Sport unveiled a comprehensive STEM
            framework designed to integrate science, technology, engineering, and mathematics across all secondary
            schools by 2027, aiming to produce 50,000 STEM graduates annually.</p>
        <div class="article-meta">
            <span>Jun 2026</span>
            <span>·</span>
            <span>5 min read</span>
        </div>
        <span class="read-more">Read article →</span>
    </div>
    <div class="featured-img">
        <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/6150103721892233908.jpg"
             alt="Cambodia STEM Festival students"
             style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">
    </div>
</a>

<!-- LATEST NEWS -->
<div class="section-gap">
    <p class="section-label">Latest</p>
    <div class="news-grid">

        <a class="news-card" href="#">
            <div class="news-card-thumb thumb-tech">
                <img src="https://stemcambodia.ngo/wp-content/uploads/2026/06/707276690_1405230471650614_3640902636218841858_n-1024x1024.jpg"
                     alt="Coding Bootcamp" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div class="news-card-body">
                <span class="news-card-tag">Technology</span>
                <p class="news-card-title">Phnom Penh Tech Hub Opens New Coding Bootcamp for Rural Youth</p>
                <p class="news-card-meta">May 2026 · 3 min read</p>
            </div>
        </a>

        <a class="news-card" href="#">
            <div class="news-card-thumb thumb-math">
                <img src="https://stemcambodia.ngo/wp-content/uploads/2026/06/707235737_1405230431650618_8614770210813328930_n-1024x1024.jpg"
                     alt="Math Olympiad" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div class="news-card-body">
                <span class="news-card-tag">Mathematics</span>
                <p class="news-card-title">Cambodian Students Win Silver at 2026 Asia-Pacific Math Olympiad</p>
                <p class="news-card-meta">May 2026 · 2 min read</p>
            </div>
        </a>

        <a class="news-card" href="#">
            <div class="news-card-thumb thumb-env">
                <img src="https://stemcambodia.ngo/wp-content/uploads/2026/06/707646851_1405230371650624_3445541354606307499_n-1024x1024.jpg"
                     alt="Environment Research" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div class="news-card-body">
                <span class="news-card-tag">Environment</span>
                <p class="news-card-title">RUPP Researchers Develop Low-Cost Water Filtration Using Local Materials</p>
                <p class="news-card-meta">Apr 2026 · 4 min read</p>
            </div>
        </a>

        <a class="news-card" href="#">
            <div class="news-card-thumb thumb-eng">
                <img src="https://stemcambodia.ngo/wp-content/uploads/elementor/thumbs/6150103721892233916-r94j6yc9823pyanpsgi2if2wuafppogkfxwqcdiiio.jpg"
                     alt="Engineering Students" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div class="news-card-body">
                <span class="news-card-tag">Engineering</span>
                <p class="news-card-title">Solar-Powered Irrigation System Built by Kampong Cham Engineering Students</p>
                <p class="news-card-meta">Apr 2026 · 3 min read</p>
            </div>
        </a>

        <a class="news-card" href="#">
            <div class="news-card-thumb thumb-health">
                <img src="https://stemcambodia.ngo/wp-content/uploads/elementor/thumbs/6150103721892233909-r94j3myr43kazth45iwg7r7decs3k4annj22e8figw.jpg"
                     alt="Health Science Research" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div class="news-card-body">
                <span class="news-card-tag">Health Science</span>
                <p class="news-card-title">IU Medical Faculty Publishes Dengue Fever Early Detection Research</p>
                <p class="news-card-meta">Mar 2026 · 5 min read</p>
            </div>
        </a>

        <a class="news-card" href="#">
            <div class="news-card-thumb thumb-tech">
                <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/STEM-Mark.png"
                     alt="STEM AI Program" style="width:100%;height:100%;object-fit:contain;padding:8px;">
            </div>
            <div class="news-card-body">
                <span class="news-card-tag">Technology</span>
                <p class="news-card-title">AI Literacy Program Reaches 12,000 Students Across 6 Provinces</p>
                <p class="news-card-meta">Mar 2026 · 3 min read</p>
            </div>
        </a>

    </div>
</div>

<!-- OLDER ARTICLES -->
<div class="section-gap">
    <p class="section-label">Earlier this year</p>
    <div class="news-grid">

        <a class="news-card" href="#">
            <div class="news-card-thumb thumb-science">
                <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/ACSF-Logo-4.png"
                     alt="ASEAN Space Research" style="width:100%;height:100%;object-fit:contain;padding:8px;">
            </div>
            <div class="news-card-body">
                <span class="news-card-tag">Science</span>
                <p class="news-card-title">Cambodia Joins ASEAN Space Research Network as Observer Member</p>
                <p class="news-card-meta">Feb 2026 · 4 min read</p>
            </div>
        </a>

        <a class="news-card" href="#">
            <div class="news-card-thumb thumb-eng">
                <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/cropped-STEM-Mark.png"
                     alt="Bridge Competition" style="width:100%;height:100%;object-fit:contain;padding:8px;">
            </div>
            <div class="news-card-body">
                <span class="news-card-tag">Engineering</span>
                <p class="news-card-title">Bridge Design Competition Draws 200 University Teams Nationwide</p>
                <p class="news-card-meta">Jan 2026 · 2 min read</p>
            </div>
        </a>

        <a class="news-card" href="#">
            <div class="news-card-thumb thumb-math">
                <img src="https://stemcambodia.ngo/wp-content/uploads/2025/06/Untitled-design-3.png"
                     alt="Data Science Degree" style="width:100%;height:100%;object-fit:contain;padding:8px;">
            </div>
            <div class="news-card-body">
                <span class="news-card-tag">Mathematics</span>
                <p class="news-card-title">New Data Science Degree Launched at Norton University Phnom Penh</p>
                <p class="news-card-meta">Jan 2026 · 3 min read</p>
            </div>
        </a>

    </div>
</div>

@endsection
