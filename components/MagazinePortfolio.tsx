"use client";

import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { FaChevronLeft, FaChevronRight, FaDownload, FaEnvelope, FaGithub, FaLinkedin } from "react-icons/fa";
import HeroPage from "./pages/HeroPage";
import AboutPage from "./pages/AboutPage";
import SkillsPage from "./pages/SkillsPage";
import ExperiencePage from "./pages/ExperiencePage";
import ProjectsPage from "./pages/ProjectsPage";
import WebsitesPage from "./pages/WebsitesPage";
import ContactPage from "./pages/ContactPage";

const MagazinePortfolio = () => {
  const [currentPage, setCurrentPage] = useState(0);
  const [direction, setDirection] = useState(0);

  const pages = [
    { component: HeroPage, title: "Home" },
    { component: AboutPage, title: "About" },
    { component: SkillsPage, title: "Skills" },
    { component: ExperiencePage, title: "Experience" },
    { component: ProjectsPage, title: "Projects" },
    { component: WebsitesPage, title: "Websites" },
    { component: ContactPage, title: "Contact" },
  ];

  const nextPage = () => {
    if (currentPage < pages.length - 1) {
      setDirection(1);
      setCurrentPage(currentPage + 1);
    }
  };

  const prevPage = () => {
    if (currentPage > 0) {
      setDirection(-1);
      setCurrentPage(currentPage - 1);
    }
  };

  const goToPage = (pageIndex: number) => {
    if (pageIndex !== currentPage) {
      setDirection(pageIndex > currentPage ? 1 : -1);
      setCurrentPage(pageIndex);
    }
  };

  const pageVariants = {
    enter: (direction: number) => ({
      rotateY: direction > 0 ? 90 : -90,
      opacity: 0,
      scale: 0.8,
    }),
    center: {
      rotateY: 0,
      opacity: 1,
      scale: 1,
    },
    exit: (direction: number) => ({
      rotateY: direction < 0 ? 90 : -90,
      opacity: 0,
      scale: 0.8,
    }),
  };

  const CurrentPageComponent = pages[currentPage].component;

  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 relative overflow-hidden">
      {/* Animated Background */}
      <div className="absolute inset-0 overflow-hidden">
        <motion.div
          animate={{
            backgroundPosition: ["0% 0%", "100% 100%"],
          }}
          transition={{
            duration: 20,
            repeat: Infinity,
            repeatType: "reverse",
          }}
          className="absolute inset-0 opacity-30"
          style={{
            backgroundImage: "radial-gradient(circle at center, rgba(139, 92, 246, 0.3) 0%, transparent 50%)",
            backgroundSize: "200% 200%",
          }}
        />
      </div>

      {/* Floating particles */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {[...Array(20)].map((_, i) => (
          <motion.div
            key={i}
            className="absolute w-2 h-2 bg-purple-400/30 rounded-full"
            animate={{
              x: [Math.random() * window.innerWidth, Math.random() * window.innerWidth],
              y: [Math.random() * window.innerHeight, Math.random() * window.innerHeight],
              scale: [1, 1.5, 1],
              opacity: [0.3, 0.6, 0.3],
            }}
            transition={{
              duration: 10 + Math.random() * 10,
              repeat: Infinity,
              ease: "linear",
            }}
            style={{
              left: Math.random() * 100 + "%",
              top: Math.random() * 100 + "%",
            }}
          />
        ))}
      </div>

      {/* Main Magazine Container */}
      <div className="relative z-10 min-h-screen flex flex-col items-center justify-center p-4 sm:p-8">
        {/* Top Navigation Bar */}
        <motion.div
          initial={{ y: -100, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          className="w-full max-w-7xl mb-6"
        >
          <div className="bg-white/10 backdrop-blur-lg rounded-2xl p-4 shadow-2xl border border-white/20">
            <div className="flex items-center justify-between">
              <motion.h1
                className="text-2xl md:text-3xl font-bold bg-gradient-to-r from-pink-400 via-purple-400 to-cyan-400 bg-clip-text text-transparent"
                animate={{ backgroundPosition: ["0%", "100%", "0%"] }}
                transition={{ duration: 5, repeat: Infinity }}
              >
                MSL Portfolio
              </motion.h1>
              
              {/* Social Links */}
              <div className="flex items-center gap-4">
                <a
                  href="https://github.com/Melissa9mpenzi"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-white/70 hover:text-white transition-colors"
                >
                  <FaGithub size={24} />
                </a>
                <a
                  href="https://www.linkedin.com/in/melissa-sharon-lokoroma-aa8681316/"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-white/70 hover:text-white transition-colors"
                >
                  <FaLinkedin size={24} />
                </a>
                <a
                  href="mailto:melissampenzi@gmail.com"
                  className="text-white/70 hover:text-white transition-colors"
                >
                  <FaEnvelope size={24} />
                </a>
                <a
                  href="/Melissa_Sharon_Lokoroma_CV.pdf"
                  download
                  className="hidden sm:flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-500 text-white rounded-full hover:shadow-lg transition-all"
                >
                  <FaDownload size={16} />
                  <span className="text-sm font-medium">Download CV</span>
                </a>
              </div>
            </div>
          </div>
        </motion.div>

        {/* Magazine/Book Container */}
        <div className="relative w-full max-w-6xl aspect-[16/10] perspective-1000">
          <motion.div
            className="absolute inset-0"
            style={{
              transformStyle: "preserve-3d",
            }}
          >
            {/* Page Content with 3D Flip Effect */}
            <div className="relative w-full h-full">
              <AnimatePresence initial={false} custom={direction} mode="wait">
                <motion.div
                  key={currentPage}
                  custom={direction}
                  variants={pageVariants}
                  initial="enter"
                  animate="center"
                  exit="exit"
                  transition={{
                    rotateY: { type: "spring", stiffness: 100, damping: 20 },
                    opacity: { duration: 0.3 },
                    scale: { duration: 0.3 },
                  }}
                  className="absolute inset-0 bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl overflow-hidden border-4 border-white/20"
                  style={{
                    transformStyle: "preserve-3d",
                    backfaceVisibility: "hidden",
                  }}
                >
                  {/* Page Shadow Effect */}
                  <div className="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-black/5 pointer-events-none" />
                  
                  {/* Page Content */}
                  <div className="relative h-full overflow-y-auto scrollbar-thin scrollbar-thumb-purple-300 scrollbar-track-transparent">
                    <CurrentPageComponent />
                  </div>

                  {/* Page Number */}
                  <div className="absolute bottom-8 right-8 text-gray-400 text-sm font-medium">
                    {currentPage + 1} / {pages.length}
                  </div>
                </motion.div>
              </AnimatePresence>
            </div>
          </motion.div>
        </div>

        {/* Navigation Controls */}
        <motion.div
          initial={{ y: 100, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          className="w-full max-w-6xl mt-6 flex items-center justify-between"
        >
          {/* Previous Button */}
          <motion.button
            onClick={prevPage}
            disabled={currentPage === 0}
            className="group relative px-6 py-3 bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 disabled:opacity-30 disabled:cursor-not-allowed transition-all hover:bg-white/20"
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
          >
            <FaChevronLeft className="text-white text-xl" />
            <span className="absolute -top-10 left-1/2 -translate-x-1/2 px-3 py-1 bg-black/80 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
              Previous Page
            </span>
          </motion.button>

          {/* Page Indicators */}
          <div className="flex items-center gap-2 px-4">
            {pages.map((page, index) => (
              <motion.button
                key={index}
                onClick={() => goToPage(index)}
                className={`relative group ${
                  currentPage === index ? "w-12" : "w-3"
                } h-3 rounded-full transition-all duration-300`}
                style={{
                  background:
                    currentPage === index
                      ? "linear-gradient(90deg, #ec4899, #8b5cf6)"
                      : "rgba(255, 255, 255, 0.3)",
                }}
                whileHover={{ scale: 1.2 }}
              >
                <span className="absolute -top-10 left-1/2 -translate-x-1/2 px-2 py-1 bg-black/80 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                  {page.title}
                </span>
              </motion.button>
            ))}
          </div>

          {/* Next Button */}
          <motion.button
            onClick={nextPage}
            disabled={currentPage === pages.length - 1}
            className="group relative px-6 py-3 bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 disabled:opacity-30 disabled:cursor-not-allowed transition-all hover:bg-white/20"
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
          >
            <FaChevronRight className="text-white text-xl" />
            <span className="absolute -top-10 left-1/2 -translate-x-1/2 px-3 py-1 bg-black/80 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
              Next Page
            </span>
          </motion.button>
        </motion.div>

        {/* Current Page Title */}
        <motion.div
          key={currentPage}
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="mt-4 text-white/70 text-sm font-medium"
        >
          {pages[currentPage].title}
        </motion.div>
      </div>
    </div>
  );
};

export default MagazinePortfolio;
