@extends('layout')
@section('title', 'Cell Biology: The Building Blocks of Life - STEM Cambodia')
@section('content')


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg);
            font-family: Georgia, 'Times New Roman', serif;
            color: #1a1a1a;
            line-height: 1.7;
        }

        .page-wrapper {
            display: flex;
            justify-content: center;
            padding: 60px 20px;
        }

        .article {
            width: 100%;
            max-width: 720px;
        }

        /* Tags */
        .tags {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tag {
            font-family: Arial, sans-serif;
            font-size: 13px;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .tag-tech {
            background-color: #e8f0e9;
            color: #2d6a4f;
            border: 1px solid #b7d5be;
        }

        .tag-beginner {
            background-color: #e8f0e9;
            color: #2d6a4f;
            border: 1px solid #b7d5be;
        }

        .read-time {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #777;
        }

        /* Title */
        h1 {
            font-size: 42px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 16px;
            color: #111;
        }

        /* Meta */
        .meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #555;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 30px;
        }

        .meta .author {
            font-weight: 700;
            color: #111;
        }

        .bookmark-icon {
            font-size: 20px;
            cursor: pointer;
        }

        /* Body text */
        p {
            font-size: 17px;
            margin-bottom: 24px;
            color: #222;
        }

        /* Tip box */
        .tip-box {
            background-color: #f0faf2;
            border-left: 4px solid #4caf7d;
            border-radius: 4px;
            padding: 16px 20px;
            margin-bottom: 30px;
            font-size: 16px;
            color: #333;
        }

        .tip-box .tip-icon {
            margin-right: 6px;
        }

        /* Headings */
        h2 {
            font-size: 26px;
            font-weight: 800;
            margin-top: 10px;
            margin-bottom: 14px;
            color: #111;
        }

        /* List */
        ul {
            list-style: none;
            padding: 0;
            margin-bottom: 30px;
        }

        ul li {
            font-size: 17px;
            padding: 6px 0;
            color: #222;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        ul li::before {
            content: "•";
            color: #333;
            font-size: 18px;
            margin-top: 1px;
            flex-shrink: 0;
        }

        ul li strong {
            font-weight: 700;
        }

        /* Code block */
        .code-block {
            background-color: #f0ede6;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 18px 20px;
            margin-bottom: 30px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            line-height: 1.8;
            color: #555;
            overflow-x: auto;
        }

        .code-block .c-comment {
            color: #999;
            font-style: italic;
        }

        .code-block .c-string {
            color: #c0392b;
        }

        .code-block .c-number {
            color: #c0392b;
        }

        .code-block .c-keyword {
            color: #2471a3;
            font-weight: bold;
        }

        .code-block .c-func {
            color: #e67e22;
        }

        .code-block .c-var {
            color: #c0392b;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid #ddd;
            margin: 40px 0 30px;
        }

        /* Post navigation */
        .post-nav {
            display: flex;
            gap: 16px;
        }

        .post-nav a {
            flex: 1;
            display: block;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px 20px;
            text-decoration: none;
            color: inherit;
            background: #fff;
        }

        .post-nav a:hover {
            background: #f0ede6;
        }

        .post-nav .nav-label {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .post-nav .nav-title {
            font-size: 16px;
            font-weight: 700;
            color: #111;
        }

        .post-nav .nav-next {
            text-align: right;
        }
    </style>

    <div class="page-wrapper">
        <article class="article">

            {{-- Tags --}}
            <div class="tags">
                <span class="tag tag-science">Science</span>
                <span class="tag tag-beginner">Beginner</span>
                <span class="read-time">7 min read</span>
            </div>

            {{-- Title --}}
            <h1>Cell Biology: The Building Blocks of Life</h1>

            {{-- Meta --}}
            <div class="meta">
                <span>By <span class="author">Admin</span> &nbsp;·&nbsp; June 2025</span>
                <span class="bookmark-icon">🔖</span>
            </div>

            {{-- Intro paragraph --}}
            <p>
                The cell is the fundamental unit of life. Every living organism — from the simplest bacterium
                to a complex human — is made of cells. Understanding cells is the foundation of all biology.
            </p>

            {{-- Tip box --}}
            <div class="tip-box">
                <span class="tip-icon">🔬</span>
                The average human body contains approximately 37 trillion cells, each performing specialised
                functions to keep you alive.
            </div>

            {{-- Key Concepts --}}
            <h2>Key Concepts</h2>

            <p>There are two primary types of cells:</p>

            <ul>
                <li><strong>Prokaryotic cells</strong> — simple cells without a nucleus (bacteria, archaea)</li>
                <li><strong>Eukaryotic cells</strong> — complex cells with a membrane-bound nucleus (plants, animals, fungi)
                </li>
            </ul>

            {{-- How It Works --}}
            <h2>How It Works</h2>

            <p>Every cell contains organelles — specialised structures that carry out specific functions:</p>

            <ul>
                <li><strong>Nucleus</strong> — contains DNA and controls cell activity</li>
                <li><strong>Mitochondria</strong> — produces energy (ATP) through cellular respiration</li>
                <li><strong>Ribosome</strong> — synthesises proteins</li>
                <li><strong>Cell membrane</strong> — controls what enters and exits the cell</li>
            </ul>

            {{-- Applications --}}
            <h2>Applications</h2>

            <p>
                Cell biology underpins modern medicine. Understanding how cells divide (mitosis and meiosis),
                communicate, and die (apoptosis) is essential for understanding cancer, genetic diseases,
                and developing new treatments.
            </p>

            {{-- Summary --}}
            <h2>Summary</h2>

            <p>
                Cells are not just building blocks — they are living machines. Every process in your body,
                from thinking to digesting food, comes down to what's happening inside individual cells.
            </p>

        </article>
    </div>

@endsection
