import './bootstrap';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", (event) => {
    // 1. Animación Hero (Principal)
    gsap.fromTo(".hero-content", 
        { autoAlpha: 0, y: 50 }, 
        { autoAlpha: 1, y: 0, duration: 1.5, ease: "power3.out", delay: 0.2 }
    );

    gsap.fromTo(".hero-bg", 
        { scale: 1.1 }, 
        { scale: 1, duration: 2, ease: "power2.out" }
    );

    // 2. Animación Quienes Somos
    const tlAbout = gsap.timeline({
        scrollTrigger: {
            trigger: "#quienes-somos",
            start: "top 75%",
        }
    });

    tlAbout.fromTo(".gs-slide-left",
        { autoAlpha: 0, x: -50 },
        { autoAlpha: 1, x: 0, duration: 1, ease: "power3.out" }
    )
    .fromTo(".gs-slide-right",
        { autoAlpha: 0, x: 50 },
        { autoAlpha: 1, x: 0, duration: 1, ease: "power3.out" },
        "-=0.7"
    );

    // 3. Comercialización y Catálogo visual (Elementos hijos)
    const fadeUpElements = gsap.utils.toArray(".gs-fade-up");
    
    fadeUpElements.forEach((element) => {
        gsap.fromTo(element,
            { autoAlpha: 0, y: 40 },
            { 
                autoAlpha: 1, 
                y: 0, 
                duration: 1, 
                ease: "power2.out",
                scrollTrigger: {
                    trigger: element,
                    start: "top 85%",
                }
            }
        );
    });

    // 4. Formulario de Consultas
    gsap.fromTo(".form-container.gs-reveal",
        { autoAlpha: 0, scale: 0.95 },
        { 
            autoAlpha: 1, 
            scale: 1, 
            duration: 1.2, 
            ease: "expo.out",
            scrollTrigger: {
                trigger: "#consultas",
                start: "top 75%",
            }
        }
    );

    // Navbar Smooth Background
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = 'rgba(10, 10, 10, 0.95)';
            navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.5)';
        } else {
            navbar.style.backgroundColor = 'rgba(10, 10, 10, 0.7)';
            navbar.style.boxShadow = 'none';
        }
    });
});
