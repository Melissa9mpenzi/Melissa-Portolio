"use client";

import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { FaChevronLeft, FaChevronRight, FaDownload, FaEnvelope, FaGithub, FaLinkedin, FaPhone, FaMapMarkerAlt, FaWhatsapp } from "react-icons/fa";
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
    { component: HeroPage, title: "Home" },
    { component: AboutPage, title: "About" },
    { component: SkillsPage, title: "Skills" },
    { component: ExperiencePage, title: "Experience" },
    { component: ProjectsPage, title: "Projects" },
    { component: WebsitesPage, title: "Websites" },
    { component: TestimonialsPage, title: "Testimonials" },
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
    <div className="min-h-screen bg-gradient-to-br from-pink-50 via-white to-rose-50 relative overflow-hidden">
      {/* Animated Background with moving gradients */}
      <div className="absolute inset-0 overflow-hidden">
        <motion.div
          animate={{
            background: [
              "radial-gradient(circle at 20% 30%, rgba(251, 207, 232, 0.4) 0%, transparent 50%)",
              "radial-gradient(circle at 80% 70%, rgba(252, 231, 243, 0.4) 0%, transparent 50%)",
              "radial-gradient(circle at 50% 50%, rgba(253, 242, 248, 0.4) 0%, transparent 50%)",
              "radial-gradient(circle at 20% 30%, rgba(251, 207, 232, 0.4) 0%, transparent 50%)",
            ],
          }}
          transition={{
            duration: 10,
            repeat: Infinity,
            ease: "linear",
          }}
          className="absolute inset-0"
        />
      </div>

      {/* Floating animated circles */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {[...Array(15)].map((_, i) => (
          <motion.div
            key={i}
            className="absolute rounded-full"
            style={{
              width: Math.random() * 200 + 50,
              height: Math.random() * 200 + 50,
              background: i % 2 === 0 
                ? "radial-gradient(circle, rgba(251, 207, 232, 0.3), transparent)"
                : "radial-gradient(circle, rgba(252, 231, 243, 0.3), transparent)",
              left: `${Math.random() * 100}%`,
              top: `${Math.random() * 100}%`,
            }}
            animate={{
              x: [0, Math.random() * 100 - 50, 0],
              y: [0, Math.random() * 100 - 50, 0],
              scale: [1, 1.2, 1],
              opacity: [0.3, 0.6, 0.3],
            }}
            transition={{
              duration: 10 + Math.random() * 10,
              repeat: Infinity,
              ease: "easeInOut",
            }}
          />
        ))}
      </div>

      {/* Main Container with Sidebar */}
      <div className="relative z-10 min-h-screen flex gap-6 p-4 sm:p-8">
        {/* Sidebar Profile Card */}
        <motion.div
          initial={{ x: -300, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          transition={{ type: "spring", stiffness: 100 }}
          className="hidden lg:block w-80 flex-shrink-0"
        >
          <motion.div
            animate={{
              y: [0, -10, 0],
            }}
            transition={{
              duration: 3,
              repeat: Infinity,
              ease: "easeInOut",
            }}
            className="sticky top-8 bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border-2 border-pink-100 overflow-hidden"
          >
            {/* Profile Image */}
            <motion.div 
              className="relative h-64 bg-gradient-to-br from-pink-200 via-rose-100 to-pink-100"
              animate={{
                background: [
                  "linear-gradient(135deg, #fce7f3 0%, #fff1f2 50%, #fce7f3 100%)",
                  "linear-gradient(135deg, #fbcfe8 0%, #fce7f3 50%, #fbcfe8 100%)",
                  "linear-gradient(135deg, #fce7f3 0%, #fff1f2 50%, #fce7f3 100%)",
                ],
              }}
              transition={{
                duration: 5,
                repeat: Infinity,
              }}
            >
              <motion.div
                animate={{
                  scale: [1, 1.05, 1],
                  rotate: [0, 2, 0, -2, 0],
                }}
                transition={{
                  duration: 4,
                  repeat: Infinity,
                }}
              >
                <Image
                  src="/Melzz.jpeg"
                  alt="Melissa Sharon Lokoroma"
                  fill
                  className="object-cover"
                  priority
                />
              </motion.div>
            </motion.div>

            {/* Profile Info */}
            <div className="p-6 text-center">
              <motion.h2
                animate={{
                  scale: [1, 1.02, 1],
                }}
                transition={{
                  duration: 2,
                  repeat: Infinity,
                }}
                className="text-2xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent mb-1"
              >
                Melissa Sharon
              </motion.h2>
              <p className="text-pink-600 font-semibold mb-2">Software Engineer</p>
              <p className="text-sm text-gray-600 mb-4">Specialization: Web Solutions Developer</p>
              <p className="text-sm text-gray-600 mb-6">
                <FaMapMarkerAlt className="inline mr-1 text-pink-500" />
                Kampala, Uganda
              </p>

              {/* Social Links */}
              <div className="flex justify-center gap-3 mb-6">
                <motion.a
                  href="https://wa.me/256765022499"
                  target="_blank"
                  rel="noopener noreferrer"
                  whileHover={{ scale: 1.3, rotate: 360, y: -5 }}
                  animate={{
                    y: [0, -5, 0],
                  }}
                  transition={{
                    y: { duration: 2, repeat: Infinity, delay: 0 },
                  }}
                  className="w-12 h-12 bg-gradient-to-br from-green-400 to-green-500 rounded-full flex items-center justify-center text-white shadow-lg hover:shadow-xl"
                >
                  <FaWhatsapp size={24} />
                </motion.a>
                <motion.a
                  href="https://github.com/Melissa9mpenzi"
                  target="_blank"
                  rel="noopener noreferrer"
                  whileHover={{ scale: 1.3, rotate: 360, y: -5 }}
                  animate={{
                    y: [0, -5, 0],
                  }}
                  transition={{
                    y: { duration: 2, repeat: Infinity, delay: 0.3 },
                  }}
                  className="w-12 h-12 bg-gradient-to-br from-gray-700 to-gray-900 rounded-full flex items-center justify-center text-white shadow-lg hover:shadow-xl"
                >
                  <FaGithub size={24} />
                </motion.a>
                <motion.a
                  href="https://www.linkedin.com/in/melissa-sharon-lokoroma-aa8681316/"
                  target="_blank"
                  rel="noopener noreferrer"
                  whileHover={{ scale: 1.3, rotate: 360, y: -5 }}
                  animate={{
                    y: [0, -5, 0],
                  }}
                  transition={{
                    y: { duration: 2, repeat: Infinity, delay: 0.6 },
                  }}
                  className="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white shadow-lg hover:shadow-xl"
                >
                  <FaLinkedin size={24} />
                </motion.a>
              </div>

              {/* Contact Info */}
              <div className="space-y-3 text-left mb-6">
                <motion.div
                  whileHover={{ x: 5 }}
                  className="flex items-center gap-3 text-sm text-gray-600 bg-pink-50 p-3 rounded-lg"
                >
                  <FaPhone className="text-pink-500" />
                  <span>+256 765 022 499</span>
                </motion.div>
                <motion.div
                  whileHover={{ x: 5 }}
                  className="flex items-center gap-3 text-sm text-gray-600 bg-pink-50 p-3 rounded-lg"
                >
                  <FaEnvelope className="text-pink-500" />
                  <span className="truncate">melissampenzi@gmail.com</span>
                </motion.div>
              </div>

              {/* CTA Button */}
              <motion.a
                href="/Melissa_Sharon_Lokoroma_CV.pdf"
                download
                whileHover={{ scale: 1.05, boxShadow: "0 20px 40px rgba(236, 72, 153, 0.3)" }}
                whileTap={{ scale: 0.95 }}
                animate={{
                  boxShadow: [
                    "0 10px 30px rgba(236, 72, 153, 0.2)",
                    "0 15px 40px rgba(236, 72, 153, 0.3)",
                    "0 10px 30px rgba(236, 72, 153, 0.2)",
                  ],
                }}
                transition={{
                  duration: 2,
                  repeat: Infinity,
                }}
                className="w-full py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-full font-semibold flex items-center justify-center gap-2"
              >
                <FaDownload />
                <span>Let&apos;s Work Together!</span>
              </motion.a>
            </div>
          </motion.div>
        </motion.div>

        {/* Main Content Area */}
        <div className="flex-1 flex flex-col">
          {/* Top Navigation Bar - Mobile */}
          <motion.div
            initial={{ y: -100, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            className="lg:hidden w-full mb-6"
          >
            <motion.div
              animate={{
                boxShadow: [
                  "0 10px 40px rgba(251, 207, 232, 0.3)",
                  "0 15px 50px rgba(252, 231, 243, 0.4)",
                  "0 10px 40px rgba(251, 207, 232, 0.3)",
                ],
              }}
              transition={{
                duration: 3,
                repeat: Infinity,
              }}
              className="bg-white/90 backdrop-blur-xl rounded-2xl p-4 border-2 border-pink-100"
            >
              <div className="flex items-center justify-between">
                <motion.h1
                  className="text-xl font-bold bg-gradient-to-r from-pink-500 via-rose-500 to-pink-600 bg-clip-text text-transparent"
                  animate={{ 
                    backgroundPosition: ["0%", "100%", "0%"],
                    scale: [1, 1.02, 1],
                  }}
                  transition={{ 
                    backgroundPosition: { duration: 5, repeat: Infinity },
                    scale: { duration: 2, repeat: Infinity },
                  }}
                >
                  MSL Portfolio
                </motion.h1>
                
                <motion.a
                  href="/Melissa_Sharon_Lokoroma_CV.pdf"
                  download
                  whileHover={{ scale: 1.1 }}
                  whileTap={{ scale: 0.9 }}
                  className="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-full hover:shadow-lg transition-all text-sm font-medium"
                >
                  <FaDownload size={14} />
                  <span>CV</span>
                </motion.a>
              </div>
            </motion.div>
          </motion.div>

          {/* Magazine/Book Container */}
          <div className="relative flex-1 perspective-1000">
            <motion.div
              className="h-full"
              style={{
                transformStyle: "preserve-3d",
              }}
            >
              {/* Page Content with 3D Flip Effect */}
              <div className="relative h-full min-h-[600px]">
                <AnimatePresence initial={false} custom={direction} mode="wait">
                  <motion.div
                    key={currentPage}
                    custom={direction}
                    variants={pageVariants}
                    initial="enter"
                    animate="center"
                    exit="exit"
                    transition={{
                      x: { type: "spring", stiffness: 300, damping: 30 },
                      opacity: { duration: 0.2 },
                      scale: { duration: 0.4 },
                      rotateY: { duration: 0.4 },
                    }}
                    className="absolute inset-0 bg-white backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border-4 border-pink-200"
                    style={{
                      transformStyle: "preserve-3d",
                      backfaceVisibility: "hidden",
                      boxShadow: "0 25px 60px rgba(251, 207, 232, 0.5), 0 10px 30px rgba(236, 72, 153, 0.3)",
                    }}
                  >
                    {/* Page Shadow Effect with pink tint */}
                    <div className="absolute inset-0 bg-gradient-to-br from-pink-50/30 via-transparent to-rose-50/30 pointer-events-none" />
                    
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
            className="w-full mt-6 flex items-center justify-between"
          >
            {/* Previous Button */}
            <motion.button
              onClick={prevPage}
              disabled={currentPage === 0}
              className="group relative px-6 py-3 bg-white/90 backdrop-blur-xl rounded-xl border-2 border-pink-200 disabled:opacity-30 disabled:cursor-not-allowed transition-all hover:bg-pink-50"
              whileHover={{ scale: 1.05, x: -5 }}
              whileTap={{ scale: 0.95 }}
              animate={{
                boxShadow: currentPage !== 0 ? [
                  "0 5px 20px rgba(251, 207, 232, 0.3)",
                  "0 8px 30px rgba(236, 72, 153, 0.4)",
                  "0 5px 20px rgba(251, 207, 232, 0.3)",
                ] : [],
              }}
              transition={{
                boxShadow: { duration: 2, repeat: Infinity },
              }}
            >
              <FaChevronLeft className="text-pink-600 text-xl" />
              <span className="absolute -top-10 left-1/2 -translate-x-1/2 px-3 py-1 bg-pink-600 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
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
                        ? "linear-gradient(90deg, #ec4899, #f43f5e, #fb7185)"
                        : "rgba(251, 207, 232, 0.5)",
                  }}
                  whileHover={{ scale: 1.3 }}
                  animate={currentPage === index ? {
                    boxShadow: [
                      "0 0 10px rgba(236, 72, 153, 0.5)",
                      "0 0 20px rgba(236, 72, 153, 0.8)",
                      "0 0 10px rgba(236, 72, 153, 0.5)",
                    ],
                  } : {}}
                  transition={{
                    boxShadow: { duration: 1.5, repeat: Infinity },
                  }}
                >
                  <span className="absolute -top-10 left-1/2 -translate-x-1/2 px-2 py-1 bg-pink-600 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                    {page.title}
                  </span>
                </motion.button>
              ))}
            </div>

            {/* Next Button */}
            <motion.button
              onClick={nextPage}
              disabled={currentPage === pages.length - 1}
              className="group relative px-6 py-3 bg-white/90 backdrop-blur-xl rounded-xl border-2 border-pink-200 disabled:opacity-30 disabled:cursor-not-allowed transition-all hover:bg-pink-50"
              whileHover={{ scale: 1.05, x: 5 }}
              whileTap={{ scale: 0.95 }}
              animate={{
                boxShadow: currentPage !== pages.length - 1 ? [
                  "0 5px 20px rgba(251, 207, 232, 0.3)",
                  "0 8px 30px rgba(236, 72, 153, 0.4)",
                  "0 5px 20px rgba(251, 207, 232, 0.3)",
                ] : [],
              }}
              transition={{
                boxShadow: { duration: 2, repeat: Infinity },
              }}
            >
              <FaChevronRight className="text-pink-600 text-xl" />
              <span className="absolute -top-10 left-1/2 -translate-x-1/2 px-3 py-1 bg-pink-600 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                Next Page
              </span>
            </motion.button>
          </motion.div>

          {/* Current Page Title */}
          <motion.div
            key={currentPage}
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="mt-4 text-pink-600 text-sm font-semibold text-center"
          >
            {pages[currentPage].title}
          </motion.div>
        </div>
      </div>
    </div>
  );
};

export default MagazinePortfolio;

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
