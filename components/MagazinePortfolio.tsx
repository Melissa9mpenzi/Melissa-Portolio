"use client";

import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import {
  FaChevronLeft,
  FaChevronRight,
  FaDownload,
  FaEnvelope,
  FaGithub,
  FaLinkedin,
  FaPhone,
  FaMapMarkerAlt,
  FaWhatsapp,
  FaMoon,
  FaSun,
} from "react-icons/fa";
import Image from "next/image";
import { useTheme } from "@/app/providers";
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
  const { theme, toggleTheme } = useTheme();

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
      x: direction > 0 ? 1000 : -1000,
      opacity: 0,
      scale: 0.5,
      rotateY: direction > 0 ? 45 : -45,
    }),
    center: {
      x: 0,
      opacity: 1,
      scale: 1,
      rotateY: 0,
    },
    exit: (direction: number) => ({
      x: direction < 0 ? 1000 : -1000,
      opacity: 0,
      scale: 0.5,
      rotateY: direction < 0 ? 45 : -45,
    }),
  };

  const CurrentPageComponent = pages[currentPage].component;

  return (
    <div className="min-h-screen bg-gradient-to-br from-pink-50 via-white to-rose-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-800 relative overflow-hidden transition-colors duration-500">
      {/* Theme Toggle Button - Fixed Position */}
      <motion.button
        onClick={toggleTheme}
        aria-label={`Switch to ${theme === "light" ? "dark" : "light"} mode`}
        title={`Switch to ${theme === "light" ? "dark" : "light"} mode`}
        initial={{ scale: 0 }}
        animate={{ scale: 1 }}
        whileHover={{ scale: 1.1, rotate: 180 }}
        whileTap={{ scale: 0.9 }}
        className="fixed top-6 right-6 z-50 flex h-12 w-12 items-center justify-center rounded-full border-2 border-pink-200 bg-white/90 shadow-2xl backdrop-blur-xl transition-colors dark:border-slate-600 dark:bg-slate-800/90 sm:h-14 sm:w-14"
      >
        <AnimatePresence mode="wait">
          {theme === "light" ? (
            <motion.div
              key="moon"
              initial={{ rotate: -180, opacity: 0 }}
              animate={{ rotate: 0, opacity: 1 }}
              exit={{ rotate: 180, opacity: 0 }}
              transition={{ duration: 0.3 }}
            >
              <FaMoon className="text-xl text-pink-600 sm:text-2xl" />
            </motion.div>
          ) : (
            <motion.div
              key="sun"
              initial={{ rotate: 180, opacity: 0 }}
              animate={{ rotate: 0, opacity: 1 }}
              exit={{ rotate: -180, opacity: 0 }}
              transition={{ duration: 0.3 }}
            >
              <FaSun className="text-2xl text-yellow-400" />
            </motion.div>
          )}
        </AnimatePresence>
      </motion.button>

      {/* Animated Background */}
      <div className="absolute inset-0 overflow-hidden">
        <motion.div
          animate={{
            background:
              theme === "light"
                ? [
                    "radial-gradient(circle at 20% 30%, rgba(251, 207, 232, 0.4) 0%, transparent 50%)",
                    "radial-gradient(circle at 80% 70%, rgba(252, 231, 243, 0.4) 0%, transparent 50%)",
                    "radial-gradient(circle at 50% 50%, rgba(253, 242, 248, 0.4) 0%, transparent 50%)",
                    "radial-gradient(circle at 20% 30%, rgba(251, 207, 232, 0.4) 0%, transparent 50%)",
                  ]
                : [
                    "radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.3) 0%, transparent 50%)",
                    "radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.3) 0%, transparent 50%)",
                    "radial-gradient(circle at 50% 50%, rgba(147, 51, 234, 0.3) 0%, transparent 50%)",
                    "radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.3) 0%, transparent 50%)",
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

      {/* Floating circles */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none">
        {[...Array(15)].map((_, i) => (
          <motion.div
            key={i}
            className="absolute rounded-full"
            style={{
              width: Math.random() * 200 + 50,
              height: Math.random() * 200 + 50,
              background:
                theme === "light"
                  ? i % 2 === 0
                    ? "radial-gradient(circle, rgba(251, 207, 232, 0.3), transparent)"
                    : "radial-gradient(circle, rgba(252, 231, 243, 0.3), transparent)"
                  : i % 2 === 0
                    ? "radial-gradient(circle, rgba(139, 92, 246, 0.2), transparent)"
                    : "radial-gradient(circle, rgba(168, 85, 247, 0.2), transparent)",
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

      {/* Main Container */}
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
            className="sticky top-8 bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl shadow-2xl border-2 border-pink-100 dark:border-purple-500/30 overflow-hidden transition-colors"
          >
            <motion.div
              className="relative h-64 bg-gradient-to-br from-pink-200 via-rose-100 to-pink-100 dark:from-purple-900 dark:via-indigo-900 dark:to-purple-800"
              animate={{
                background:
                  theme === "light"
                    ? [
                        "linear-gradient(135deg, #fce7f3 0%, #fff1f2 50%, #fce7f3 100%)",
                        "linear-gradient(135deg, #fbcfe8 0%, #fce7f3 50%, #fbcfe8 100%)",
                        "linear-gradient(135deg, #fce7f3 0%, #fff1f2 50%, #fce7f3 100%)",
                      ]
                    : [
                        "linear-gradient(135deg, #581c87 0%, #4c1d95 50%, #581c87 100%)",
                        "linear-gradient(135deg, #6b21a8 0%, #581c87 50%, #6b21a8 100%)",
                        "linear-gradient(135deg, #581c87 0%, #4c1d95 50%, #581c87 100%)",
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

            <div className="p-6 text-center">
              <motion.h2
                animate={{
                  scale: [1, 1.02, 1],
                }}
                transition={{
                  duration: 2,
                  repeat: Infinity,
                }}
                className="text-2xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 dark:from-purple-400 dark:to-pink-400 bg-clip-text text-transparent mb-1"
              >
                Melissa Sharon
              </motion.h2>
              <p className="text-pink-600 dark:text-purple-400 font-semibold mb-2">
                Software Engineer
              </p>
              <p className="text-sm text-gray-600 dark:text-gray-300 mb-4">
                Specialization: Web Solutions Developer
              </p>
              <p className="text-sm text-gray-600 dark:text-gray-400 mb-6">
                <FaMapMarkerAlt className="inline mr-1 text-pink-500 dark:text-purple-400" />
                Kampala, Uganda
              </p>

              <div className="flex justify-center gap-3 mb-6">
                {[
                  {
                    Icon: FaWhatsapp,
                    href: "https://wa.me/256765022499",
                    color: "from-green-400 to-green-500",
                  },
                  {
                    Icon: FaGithub,
                    href: "https://github.com/Melissa9mpenzi",
                    color: "from-gray-700 to-gray-900",
                  },
                  {
                    Icon: FaLinkedin,
                    href: "https://www.linkedin.com/in/melissa-sharon-lokoroma-aa8681316/",
                    color: "from-blue-500 to-blue-600",
                  },
                ].map(({ Icon, href, color }, idx) => (
                  <motion.a
                    key={idx}
                    href={href}
                    target="_blank"
                    rel="noopener noreferrer"
                    whileHover={{ scale: 1.3, rotate: 360, y: -5 }}
                    animate={{
                      y: [0, -5, 0],
                    }}
                    transition={{
                      y: { duration: 2, repeat: Infinity, delay: idx * 0.3 },
                    }}
                    className={`w-12 h-12 bg-gradient-to-br ${color} rounded-full flex items-center justify-center text-white shadow-lg hover:shadow-xl`}
                  >
                    <Icon size={24} />
                  </motion.a>
                ))}
              </div>

              <div className="space-y-3 text-left mb-6">
                {[
                  { Icon: FaPhone, text: "+256 765 022 499" },
                  { Icon: FaEnvelope, text: "melissampenzi@gmail.com" },
                ].map(({ Icon, text }, idx) => (
                  <motion.div
                    key={idx}
                    whileHover={{ x: 5 }}
                    className="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300 bg-pink-50 dark:bg-gray-700/50 p-3 rounded-lg"
                  >
                    <Icon className="text-pink-500 dark:text-purple-400" />
                    <span className="truncate">{text}</span>
                  </motion.div>
                ))}
              </div>

              <motion.a
                href="/Melissa_Sharon_Lokoroma_CV.pdf"
                download
                whileHover={{
                  scale: 1.05,
                  boxShadow: "0 20px 40px rgba(236, 72, 153, 0.3)",
                }}
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
                className="w-full py-3 bg-gradient-to-r from-pink-500 to-rose-500 dark:from-purple-600 dark:to-pink-600 text-white rounded-full font-semibold flex items-center justify-center gap-2"
              >
                <FaDownload />
                <span>Let&apos;s Work Together!</span>
              </motion.a>
            </div>
          </motion.div>
        </motion.div>

        {/* Main Content Area */}
        <div className="flex-1 flex flex-col">
          {/* Mobile Header */}
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
              className="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl p-4 border-2 border-pink-100 dark:border-purple-500/30"
            >
              <div className="flex items-center justify-between">
                <motion.h1
                  className="text-xl font-bold bg-gradient-to-r from-pink-500 via-rose-500 to-pink-600 dark:from-purple-400 dark:via-pink-400 dark:to-purple-500 bg-clip-text text-transparent"
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
                  className="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-pink-500 to-rose-500 dark:from-purple-600 dark:to-pink-600 text-white rounded-full hover:shadow-lg transition-all text-sm font-medium"
                >
                  <FaDownload size={14} />
                  <span>CV</span>
                </motion.a>
              </div>
            </motion.div>
          </motion.div>

          {/* Magazine Container */}
          <div className="relative flex-1 perspective-1000">
            <motion.div
              className="h-full"
              style={{
                transformStyle: "preserve-3d",
              }}
            >
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
                    className="absolute inset-0 bg-white dark:bg-gray-800 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border-4 border-pink-200 dark:border-purple-500/30 transition-colors"
                    style={{
                      transformStyle: "preserve-3d",
                      backfaceVisibility: "hidden",
                      boxShadow:
                        theme === "light"
                          ? "0 25px 60px rgba(251, 207, 232, 0.5), 0 10px 30px rgba(236, 72, 153, 0.3)"
                          : "0 25px 60px rgba(139, 92, 246, 0.4), 0 10px 30px rgba(168, 85, 247, 0.3)",
                    }}
                  >
                    <div className="absolute inset-0 bg-gradient-to-br from-pink-50/30 via-transparent to-rose-50/30 dark:from-purple-900/20 dark:via-transparent dark:to-indigo-900/20 pointer-events-none" />

                    <div className="relative h-full overflow-y-auto scrollbar-thin scrollbar-thumb-purple-300 scrollbar-track-transparent">
                      <CurrentPageComponent />
                    </div>

                    <div className="absolute bottom-8 right-8 text-gray-400 dark:text-gray-500 text-sm font-medium">
                      {currentPage + 1} / {pages.length}
                    </div>
                  </motion.div>
                </AnimatePresence>
              </div>
            </motion.div>
          </div>

          {/* Navigation */}
          <motion.div
            initial={{ y: 100, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            className="w-full mt-6 flex items-center justify-between"
          >
            <motion.button
              onClick={prevPage}
              disabled={currentPage === 0}
              className="group relative px-6 py-3 bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-xl border-2 border-pink-200 dark:border-purple-500/30 disabled:opacity-30 disabled:cursor-not-allowed transition-all hover:bg-pink-50 dark:hover:bg-gray-700"
              whileHover={{ scale: 1.05, x: -5 }}
              whileTap={{ scale: 0.95 }}
              animate={{
                boxShadow:
                  currentPage !== 0
                    ? [
                        "0 5px 20px rgba(251, 207, 232, 0.3)",
                        "0 8px 30px rgba(236, 72, 153, 0.4)",
                        "0 5px 20px rgba(251, 207, 232, 0.3)",
                      ]
                    : [],
              }}
              transition={{
                boxShadow: { duration: 2, repeat: Infinity },
              }}
            >
              <FaChevronLeft className="text-pink-600 dark:text-purple-400 text-xl" />
              <span className="absolute -top-10 left-1/2 -translate-x-1/2 px-3 py-1 bg-pink-600 dark:bg-purple-600 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                Previous Page
              </span>
            </motion.button>

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
                        ? theme === "light"
                          ? "linear-gradient(90deg, #ec4899, #f43f5e, #fb7185)"
                          : "linear-gradient(90deg, #a855f7, #ec4899, #d946ef)"
                        : theme === "light"
                          ? "rgba(251, 207, 232, 0.5)"
                          : "rgba(139, 92, 246, 0.3)",
                  }}
                  whileHover={{ scale: 1.3 }}
                  animate={
                    currentPage === index
                      ? {
                          boxShadow: [
                            "0 0 10px rgba(236, 72, 153, 0.5)",
                            "0 0 20px rgba(236, 72, 153, 0.8)",
                            "0 0 10px rgba(236, 72, 153, 0.5)",
                          ],
                        }
                      : {}
                  }
                  transition={{
                    boxShadow: { duration: 1.5, repeat: Infinity },
                  }}
                >
                  <span className="absolute -top-10 left-1/2 -translate-x-1/2 px-2 py-1 bg-pink-600 dark:bg-purple-600 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                    {page.title}
                  </span>
                </motion.button>
              ))}
            </div>

            <motion.button
              onClick={nextPage}
              disabled={currentPage === pages.length - 1}
              className="group relative px-6 py-3 bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-xl border-2 border-pink-200 dark:border-purple-500/30 disabled:opacity-30 disabled:cursor-not-allowed transition-all hover:bg-pink-50 dark:hover:bg-gray-700"
              whileHover={{ scale: 1.05, x: 5 }}
              whileTap={{ scale: 0.95 }}
              animate={{
                boxShadow:
                  currentPage !== pages.length - 1
                    ? [
                        "0 5px 20px rgba(251, 207, 232, 0.3)",
                        "0 8px 30px rgba(236, 72, 153, 0.4)",
                        "0 5px 20px rgba(251, 207, 232, 0.3)",
                      ]
                    : [],
              }}
              transition={{
                boxShadow: { duration: 2, repeat: Infinity },
              }}
            >
              <FaChevronRight className="text-pink-600 dark:text-purple-400 text-xl" />
              <span className="absolute -top-10 left-1/2 -translate-x-1/2 px-3 py-1 bg-pink-600 dark:bg-purple-600 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                Next Page
              </span>
            </motion.button>
          </motion.div>

          <motion.div
            key={currentPage}
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="mt-4 text-pink-600 dark:text-purple-400 text-sm font-semibold text-center"
          >
            {pages[currentPage].title}
          </motion.div>
        </div>
      </div>
    </div>
  );
};

export default MagazinePortfolio;
