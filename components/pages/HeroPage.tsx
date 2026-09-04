"use client";

import { motion } from "framer-motion";
import { FaArrowRight, FaDownload, FaStar } from "react-icons/fa";

const HeroPage = () => {
  return (
    <div className="relative flex min-h-[600px] items-center overflow-hidden px-7 py-14 sm:px-12 lg:px-20">
      <div className="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full bg-pink-200/40 blur-3xl" />
      <div className="relative max-w-4xl">
        <motion.div
          initial={{ opacity: 0, y: 18 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.15 }}
          className="mb-8 inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white/55 px-4 py-2 text-sm font-medium text-slate-600"
        >
          <FaStar className="text-pink-500" /> Let&apos;s build something useful
        </motion.div>
        <motion.p
          initial={{ opacity: 0, y: 18 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.25 }}
          className="mb-4 text-sm font-bold uppercase tracking-[0.22em] text-pink-500"
        >
          Web Solutions Developer
        </motion.p>
        <motion.h2
          initial={{ opacity: 0, y: 24 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.35 }}
          className="max-w-4xl text-5xl font-bold leading-[0.98] tracking-tight text-slate-900 sm:text-7xl lg:text-8xl"
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
          className="mt-8 max-w-2xl text-lg leading-8 text-slate-600 sm:text-xl"
        >
          I&apos;m Melissa Sharon Lokoroma, a software engineer creating
          thoughtful web experiences with React, Next.js, Python, and WordPress.
        </motion.p>
        <motion.div
          initial={{ opacity: 0, y: 18 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.65 }}
          className="mt-10 flex flex-wrap items-center gap-4"
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
          className="mt-14 flex gap-10 border-t border-slate-300/80 pt-6"
        >
          <div>
            <p className="text-3xl font-bold text-slate-900">4+</p>
            <p className="text-sm text-slate-500">Years building</p>
          </div>
          <div>
            <p className="text-3xl font-bold text-slate-900">18+</p>
            <p className="text-sm text-slate-500">Projects shipped</p>
          </div>
          <div>
            <p className="text-3xl font-bold text-slate-900">UG</p>
            <p className="text-sm text-slate-500">Working from Kampala</p>
          </div>
        </motion.div>
      </div>
    </div>
  );
};

export default HeroPage;
