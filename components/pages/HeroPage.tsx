"use client";

import { motion } from "framer-motion";
import { FaArrowDown, FaArrowRight, FaDownload, FaStar } from "react-icons/fa";

const HeroPage = ({ onNext }: { onNext?: () => void }) => {
  return (
    <div className="relative flex min-h-0 items-center overflow-hidden bg-white px-7 py-8 text-slate-900 dark:bg-slate-800 dark:text-white sm:px-12 sm:py-10 lg:px-20 lg:py-12">
      <div className="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full bg-pink-200/40 blur-3xl dark:bg-pink-900/30" />
      <div className="relative max-w-4xl">
        <motion.div
          initial={{ opacity: 0, y: 18 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.15 }}
          className="mb-5 inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white/55 px-4 py-2 text-sm font-medium text-slate-600 dark:border-slate-600 dark:bg-slate-700/70 dark:text-slate-200"
        >
          <FaStar className="text-pink-500" /> Let&apos;s build something useful
        </motion.div>
        <motion.p
          initial={{ opacity: 0, y: 18 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.25 }}
          className="mb-3 text-sm font-bold uppercase tracking-[0.22em] text-pink-500"
        >
          Software Engineer
        </motion.p>
        <motion.h2
          initial={{ opacity: 0, y: 24 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.35 }}
          className="max-w-4xl text-4xl font-bold leading-[1] tracking-tight text-slate-900 dark:text-white sm:text-6xl lg:text-7xl"
        >
          I make digital products feel{" "}
          <span className="bg-gradient-to-r from-pink-500 to-rose-400 bg-clip-text text-transparent">
            clear.
          </span>
        </motion.h2>
        <motion.p
          initial={{ opacity: 0, y: 18 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.5 }}
          className="mt-5 max-w-2xl text-base leading-7 text-slate-600 dark:text-slate-300 sm:text-lg"
        >
          I&apos;m Melissa Sharon Lokoroma, a software engineer and web
          solutions developer creating thoughtful experiences with React,
          Next.js, Python, and WordPress.
        </motion.p>
        <motion.div
          initial={{ opacity: 0, y: 18 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.65 }}
          className="mt-7 flex flex-wrap items-center gap-4"
        >
          <a
            href="#contact"
            className="inline-flex items-center gap-3 rounded-full bg-slate-900 px-6 py-3.5 font-semibold text-white shadow-xl shadow-slate-900/15 transition hover:-translate-y-0.5 hover:bg-pink-600"
          >
            Start a conversation <FaArrowRight />
          </a>
          <a
            href="/Melissa_Sharon_Lokoroma_CV.pdf"
            download
            className="inline-flex items-center gap-3 rounded-full border border-pink-200 bg-white/60 px-6 py-3.5 font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-pink-400 hover:text-pink-600"
          >
            <FaDownload /> Download CV
          </a>
        </motion.div>
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 0.85 }}
          className="mt-8 flex gap-8 border-t border-slate-300/80 pt-5 dark:border-slate-600"
        >
          <div>
            <p className="text-3xl font-bold text-slate-900 dark:text-white">
              4+
            </p>
            <p className="text-sm text-slate-500 dark:text-slate-400">
              Years building
            </p>
          </div>
          <div>
            <p className="text-3xl font-bold text-slate-900 dark:text-white">
              18+
            </p>
            <p className="text-sm text-slate-500 dark:text-slate-400">
              Projects shipped
            </p>
          </div>
          <div>
            <p className="text-3xl font-bold text-slate-900 dark:text-white">
              UG
            </p>
            <p className="text-sm text-slate-500 dark:text-slate-400">
              Working from Kampala
            </p>
          </div>
        </motion.div>
        <motion.button
          type="button"
          onClick={onNext}
          aria-label="Scroll to the next page"
          initial={{ opacity: 0, scale: 0.8 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ delay: 1, type: "spring" }}
          whileHover={{ scale: 1.06 }}
          className="absolute bottom-6 right-6 hidden h-28 w-28 items-center justify-center rounded-full border border-pink-300 bg-pink-50/70 text-pink-700 shadow-lg shadow-pink-300/20 backdrop-blur-sm sm:flex"
        >
          <span className="absolute inset-2 flex items-center justify-center rounded-full border border-dashed border-pink-300 text-[10px] font-bold uppercase tracking-[0.18em]">
            <span className="absolute -top-1 bg-pink-50 px-1">
              Scroll for more
            </span>
            <FaArrowDown className="mt-2 text-xl" />
          </span>
        </motion.button>
      </div>
    </div>
  );
};

export default HeroPage;
