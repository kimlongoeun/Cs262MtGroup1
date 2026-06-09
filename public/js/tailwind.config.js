// public/js/tailwind.config.js
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary-fixed-dim": "#4edea3",
                "on-primary-fixed": "#002113",
                "surface-container-low": "#eff4ff",
                "surface-bright": "#f8f9ff",
                "outline-variant": "#bbcabf",
                "inverse-primary": "#4edea3",
                "on-error": "#ffffff",
                "outline": "#6c7a71",
                "on-error-container": "#93000a",
                "background": "#f8f9ff",
                "on-primary": "#ffffff",
                "on-secondary-fixed-variant": "#3f465c",
                "primary-container": "#10b981",
                "tertiary-container": "#71a1ff",
                "on-background": "#0b1c30",
                "on-tertiary-fixed-variant": "#004395",
                "surface-tint": "#006c49",
                "on-secondary-fixed": "#131b2e",
                "inverse-on-surface": "#eaf1ff",
                "surface-variant": "#d3e4fe",
                "on-tertiary-container": "#00367a",
                "inverse-surface": "#213145",
                "surface": "#f8f9ff",
                "tertiary-fixed-dim": "#adc6ff",
                "on-secondary": "#ffffff",
                "surface-container": "#e5eeff",
                "surface-dim": "#cbdbf5",
                "on-primary-fixed-variant": "#005236",
                "secondary": "#565e74",
                "surface-container-highest": "#d3e4fe",
                "on-tertiary": "#ffffff",
                "secondary-container": "#dae2fd",
                "error-container": "#ffdad6",
                "on-surface-variant": "#3c4a42",
                "primary": "#006c49",
                "secondary-fixed-dim": "#bec6e0",
                "tertiary": "#005ac2",
                "primary-fixed": "#6ffbbe",
                "secondary-fixed": "#dae2fd",
                "error": "#ba1a1a",
                "on-primary-container": "#00422b",
                "on-surface": "#0b1c30",
                "surface-container-high": "#dce9ff",
                "surface-container-lowest": "#ffffff",
                "tertiary-fixed": "#d8e2ff",
                "on-tertiary-fixed": "#001a42",
                "on-secondary-container": "#5c647a"
            },
            borderRadius: {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            spacing: {
                "md": "24px",
                "base": "8px",
                "lg": "48px",
                "xl": "80px",
                "xs": "4px",
                "sm": "12px",
                "gutter": "24px",
                "container-max": "1280px"
            },
            fontFamily: {
                "headline-md": ["Plus Jakarta Sans"],
                "body-md": ["Inter"],
                "display-lg-mobile": ["Plus Jakarta Sans"],
                "label-sm": ["Inter"],
                "khmer-body": ["Noto Sans Khmer"],
                "body-lg": ["Inter"],
                "display-lg": ["Plus Jakarta Sans"]
            },
            fontSize: {
                "headline-md": ["24px", { lineHeight: "1.3", fontWeight: "600" }],
                "body-md": ["16px", { lineHeight: "1.5", fontWeight: "400" }],
                "display-lg-mobile": ["32px", { lineHeight: "1.2", fontWeight: "700" }],
                "label-sm": ["12px", { lineHeight: "1", letterSpacing: "0.05em", fontWeight: "600" }],
                "khmer-body": ["16px", { lineHeight: "1.8", fontWeight: "400" }],
                "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }],
                "display-lg": ["48px", { lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "700" }]
            }
        }
    }
}