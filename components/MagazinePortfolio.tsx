"use client";

import { useState } from "react";
import { AnimatePresence, motion } from "framer-motion";
import {
  FaBriefcase,
  FaChevronLeft,
  FaChevronRight,
  FaCode,
  FaComments,
  FaDownload,
  FaEnvelope,
  FaGithub,
  FaHome,
  FaLinkedin,
  FaMapMarkerAlt,
  FaPhone,
  FaUser,
  FaWhatsapp,
} from "react-icons/fa";
import Image from "next/image";
import HeroPage from "./pages/HeroPage";
import AboutPage from "./pages/AboutPage";
import SkillsPage from "./pages/SkillsPage";
import ExperiencePage from "./pages/ExperiencePage";
import ProjectsPage from "./pages/ProjectsPage";
import WebsitesPage from "./pages/WebsitesPage";
import TestimonialsPage from "./pages/TestimonialsPage";
import ContactPage from "./pages/ContactPage";

const MagazinePortfolio = () => {
  const [currentPage, setCurrentPage] = useState(0);
  const [direction, setDirection] = useState(0);
  const pages = [
    { component: HeroPage, title: "Home", icon: FaHome },
    { component: AboutPage, title: "About", icon: FaUser },
    { component: SkillsPage, title: "Skills", icon: FaCode },
    { component: ExperiencePage, title: "Experience", icon: FaBriefcase },
    { component: ProjectsPage, title: "Projects", icon: FaCode },
    { component: WebsitesPage, title: "Websites", icon: FaCode },
    { component: TestimonialsPage, title: "Testimonials", icon: FaComments },
    { component: ContactPage, title: "Contact", icon: FaEnvelope },
  ];

  const goToPage = (pageIndex: number) => {
    if (pageIndex === currentPage) return;
    setDirection(pageIndex > currentPage ? 1 : -1);
    setCurrentPage(pageIndex);
  };

  const CurrentPageComponent = pages[currentPage].component;

  return (
    <main className="min-h-screen overflow-hidden bg-[#fff5f8] text-slate-900">
      <div className="pointer-events-none fixed inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(251,182,206,.38),transparent_34%),radial-gradient(circle_at_82%_86%,rgba(254,205,211,.28),transparent_35%)]" />
      <div className="relative z-10 flex min-h-screen gap-6 p-4 sm:p-6 lg:p-8">
        <motion.aside
          initial={{ x: 40, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          className="order-2 hidden w-[300px] shrink-0 lg:block"
        >
          <div className="sticky top-8 overflow-hidden rounded-[2.5rem] border border-pink-200/80 bg-[#fffafd]/80 p-5 shadow-[0_24px_70px_rgba(190,92,126,0.14)] backdrop-blur-xl">
            <h1 className="mb-5 text-center text-3xl font-bold tracking-tight">
              Melissa Sharon
            </h1>
            <div className="relative mb-7 h-64 overflow-hidden rounded-[2rem] bg-gradient-to-br from-pink-100 via-white to-rose-100">
              <Image
                src="/Melzz.jpeg"
                alt="Melissa Sharon Lokoroma"
                fill
                className="object-cover"
                priority
              />
            </div>
            <div className="space-y-5 px-1">
              <div>
                <p className="text-sm text-slate-500">Role:</p>
                <p className="font-semibold">Software Engineer</p>
                <p className="mt-1 text-sm text-slate-600">Web Solutions Developer</p>
              </div>
              <div>
                <p className="text-sm text-slate-500">Based in:</p>
                <p className="font-semibold">
                  <FaMapMarkerAlt className="mr-1 inline text-pink-500" />
                  Kampala, Uganda
                </p>
              </div>
              <div className="flex gap-2">
                <a
                  aria-label="WhatsApp"
                  href="https://wa.me/256759933134"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex h-10 w-10 items-center justify-center rounded-full border border-pink-200 bg-white text-slate-700 transition hover:-translate-y-1 hover:border-pink-400"
                >
                  <FaWhatsapp />
                </a>
                <a
                  aria-label="GitHub"
                  href="https://github.com/Melissa9mpenzi"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex h-10 w-10 items-center justify-center rounded-full border border-pink-200 bg-white text-slate-700 transition hover:-translate-y-1 hover:border-pink-400"
                >
                  <FaGithub />
                </a>
                <a
                  aria-label="LinkedIn"
                  href="https://www.linkedin.com/in/melissa-sharon-lokoroma-aa8681316/"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex h-10 w-10 items-center justify-center rounded-full border border-pink-200 bg-white text-slate-700 transition hover:-translate-y-1 hover:border-pink-400"
                >
                  <FaLinkedin />
                </a>
              </div>
              <div className="space-y-2 border-t border-slate-300/70 pt-4 text-sm text-slate-600">
                <p>
                  <FaPhone className="mr-2 inline text-pink-500" />
                  +256 759 933 134
                </p>
                <p className="truncate">
                  <FaEnvelope className="mr-2 inline text-pink-500" />
                  melissampenzi@gmail.com
                </p>
              </div>
              <a
                href="/Melissa_Sharon_Lokoroma_CV.pdf"
                download
                className="flex w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-pink-500 to-rose-400 py-3 font-semibold text-white shadow-lg shadow-pink-500/20 transition hover:-translate-y-0.5"
              >
                <FaDownload /> Let&apos;s Work Together
              </a>
            </div>
          </div>
        </motion.aside>

        <section className="flex min-w-0 flex-1 flex-col">
          <div className="mb-5 flex items-center justify-between lg:justify-end">
            <span className="text-xl font-bold tracking-tight lg:hidden">
              MSL<span className="text-pink-500">.</span>
            </span>
            <nav
              className="flex max-w-full items-center gap-1 overflow-x-auto rounded-2xl border border-pink-200/80 bg-[#fffafd]/80 p-1 shadow-lg shadow-pink-300/10 backdrop-blur-xl sm:gap-2 sm:rounded-full sm:p-2"
              aria-label="Portfolio sections"
            >
              {pages.map(({ title, icon: Icon }, index) => (
                <button
                  key={title}
                  onClick={() => goToPage(index)}
                  aria-label={title}
                  aria-current={currentPage === index ? "page" : undefined}
                  className={`flex shrink-0 items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium transition sm:rounded-full sm:px-4 ${currentPage === index ? "bg-white text-pink-600 shadow-sm" : "text-slate-500 hover:bg-white/70 hover:text-pink-600"}`}
                >
                  <Icon />
                  <span className="hidden md:inline">{title}</span>
                </button>
              ))}
              <a
                href="mailto:melissampenzi@gmail.com"
                className="hidden rounded-full bg-gradient-to-r from-pink-500 to-rose-400 px-5 py-2.5 font-semibold text-white sm:block"
              >
                Let&apos;s Talk <FaComments className="ml-1 inline" />
              </a>
            </nav>
          </div>

          <div className="relative min-h-[600px] flex-1 overflow-hidden rounded-[2rem] border border-pink-100 bg-white/75 shadow-[0_24px_70px_rgba(190,92,126,0.14)] backdrop-blur-xl lg:rounded-[2.5rem]">
            <AnimatePresence initial={false} custom={direction} mode="wait">
              <motion.div
                key={currentPage}
                custom={direction}
                initial={{ opacity: 0, x: direction * 40 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: direction * -40 }}
                transition={{ duration: 0.3 }}
                className="h-full"
              >
                <div className="h-full overflow-y-auto scrollbar-thin scrollbar-thumb-purple-300 scrollbar-track-transparent">
                  <CurrentPageComponent />
                </div>
              </motion.div>
            </AnimatePresence>
            <span className="absolute bottom-6 right-7 text-sm font-medium text-slate-400">
              {currentPage + 1} / {pages.length}
            </span>
          </div>

          <div className="mt-5 flex items-center justify-between text-sm text-slate-500">
            <button
              onClick={() => goToPage(Math.max(0, currentPage - 1))}
              disabled={currentPage === 0}
              aria-label="Previous page"
              className="rounded-full border border-pink-200 bg-white/60 p-3 transition hover:text-pink-600 disabled:opacity-30"
            >
              <FaChevronLeft />
            </button>
            <span className="font-semibold text-pink-600">
              {pages[currentPage].title}
            </span>
            <button
              onClick={() =>
                goToPage(Math.min(pages.length - 1, currentPage + 1))
              }
              disabled={currentPage === pages.length - 1}
              aria-label="Next page"
              className="rounded-full border border-pink-200 bg-white/60 p-3 transition hover:text-pink-600 disabled:opacity-30"
            >
              <FaChevronRight />
            </button>
          </div>
        </section>
      </div>
    </main>
  );
};

export default MagazinePortfolio;
