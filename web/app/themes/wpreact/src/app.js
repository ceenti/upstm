import React from 'react';
import { createRoot } from 'react-dom/client'
import { createInertiaApp } from '@inertiajs/inertia-react'
import './assets/scss/app.scss'
import 'aos/dist/aos.css';
import AOS from 'aos';

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, App, props }) {
        const root = createRoot(el);
        root.render(<App {...props} />)
        AOS.init({ once: true, offset: 200, duration: 600, easing: 'ease-out-cubic'}, [])
    },
})
