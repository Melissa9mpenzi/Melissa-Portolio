"use client";

import { motion } from "framer-motion";
import { FaDownload, FaCode, FaRocket, FaPalette } from "react-icons/fa";

const HeroPage = () => {
  return (
    <div className="h-full flex items-center justify-center p-8 sm:p-16 bg-gradient-to-br from-purple-50 via-pink-50 to-cyan-50">
      <div className="max-w-4xl text-center">
        {/* Animated Avatar */}
        <motion.div
          initial={{ scale: 0, rotate: -180 }}
          animate={{ scale: 1, rotate: 0 }}
          transition={{ type: "spring", stiffness: 100, delay: 0.2 }}
          className="mb-8 flex justify-center"
        >
          <div className="relative">
            <motion.div
              animate={{
                boxShadow: [
                  "0 0 20px rgba(236, 72, 153, 0.5)",
                  "0 0 40px rgba(139, 92, 246, 0.5)",
                  "0 0 20px rgba(236, 72, 153, 0.5)",
                ],
              }}
              transition={{ duration: 2, repeat: Infinity }}
              className="w-32 h-32 sm:w-40 sm:h-40 rounded-full bg-gradient-to-br from-pink-500 via-purple-500 to-cyan-500 flex items-center justify-center text-white text-5xl sm:text-6xl font-bold"
            >
              ML
            </motion.div>
            <motion.div
              animate={{ rotate: 360 }}
              transition={{ duration: 20, repeat: Infinity, ease: "linear" }}
              className="absolute inset-0 border-4 border-dashed border-purple-300 rounded-full"
            />
          </div>
        </motion.div>

        {/* Name with animated gradient */}
        <motion.h1
          initial={{ y: 50, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          transition={{ delay: 0.4 }}
          className="text-4xl sm:text-6xl md:text-7xl font-bold mb-4"
        >
          <motion.span
            className="block text-xl sm:text-2xl text-gray-600 font-normal mb-2"
            initial={{ x: -20, opacity: 0 }}
            animate={{ x: 0, opacity: 1 }}
            transition={{ delay: 0.3 }}
          >
            Let&apos;s meet!
          </motion.span>
          <motion.span
            className="block text-2xl sm:text-3xl text-gray-700 mb-2"
            initial={{ x: -20, opacity: 0 }}
            animate={{ x: 0, opacity: 1 }}
            transition={{ delay: 0.35 }}
          >
            I&apos;m
          </motion.span>
          <motion.span
            animate={{
              backgroundPosition: ["0%", "100%", "0%"],
            }}
            transition={{ duration: 5, repeat: Infinity }}
            className="bg-gradient-to-r from-pink-600 via-purple-600 to-cyan-600 bg-clip-text text-transparent bg-[length:200%_auto]"
          >
            Melissa Sharon Lokoroma
          </motion.span>
        </motion.h1>

        {/* Title */}
        <motion.div
          initial={{ y: 30, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          transition={{ delay: 0.6 }}
          className="mb-6"
        >
          <h2 className="text-2xl sm:text-3xl text-gray-700 font-semibold mb-2">
            Web Solutions Developer
          </h2>
          <p className="text-xl text-gray-600">Software Engineer</p>
        </motion.div>

        {/* Description */}
        <motion.p
          initial={{ y: 20, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          transition={{ delay: 0.8 }}
          className="text-lg text-gray-600 mb-8 max-w-2xl mx-auto"
        >
          Transforming ideas into beautiful, functional digital experiences with{" "}
          <span className="font-semibold text-purple-600">4+ years</span> of expertise
          in modern web technologies.
        </motion.p>

        {/* Feature Cards */}
        <motion.div
          initial={{ y: 20, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          transition={{ delay: 1 }}
          className="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8"
        >
          {[
            { icon: FaCode, text: "Modern Development", color: "from-pink-500 to-rose-500" },
            { icon: FaPalette, text: "Creative Design", color: "from-purple-500 to-indigo-500" },
            { icon: FaRocket, text: "Fast Delivery", color: "from-cyan-500 to-blue-500" },
          ].map((item, index) => (
            <motion.div
              key={index}
              whileHover={{ scale: 1.05, y: -5 }}
              className="bg-white/50 backdrop-blur-sm rounded-xl p-4 border border-gray-200 shadow-lg"
            >
              <motion.div
                animate={{ rotate: [0, 360] }}
                transition={{ duration: 3, repeat: Infinity, ease: "linear" }}
              >
                <div className={`w-12 h-12 mx-auto mb-2 rounded-lg bg-gradient-to-br ${item.color} flex items-center justify-center text-white`}>
                  <item.icon size={24} />
                </div>
              </motion.div>
              <p className="text-sm font-medium text-gray-700">{item.text}</p>
            </motion.div>
          ))}
        </motion.div>

        {/* CTA Button */}
        <motion.div
          initial={{ scale: 0 }}
          animate={{ scale: 1 }}
          transition={{ delay: 1.2, type: "spring", stiffness: 200 }}
        >
          <motion.a
            href="/Melissa_Sharon_Lokoroma_CV.pdf"
            download
            whileHover={{ scale: 1.1 }}
            whileTap={{ scale: 0.95 }}
            className="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500 text-white rounded-full font-semibold text-lg shadow-2xl hover:shadow-purple-500/50 transition-shadow"
          >
            <FaDownload />
            <span>Download My CV</span>
          </motion.a>
        </motion.div>

        {/* Stats */}
        <motion.div
          initial={{ y: 20, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          transition={{ delay: 1.4 }}
          className="mt-12 flex justify-center gap-8 text-center"
        >
          {[
            { number: "4+", label: "Years" },
            { number: "18+", label: "Projects" },
            { number: "680+", label: "Dev Hours" },
          ].map((stat, index) => (
            <div key={index}>
              <motion.div
                animate={{ scale: [1, 1.2, 1] }}
                transition={{ duration: 2, repeat: Infinity, delay: index * 0.2 }}
                className="text-3xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent"
              >
                {stat.number}
              </motion.div>
              <div className="text-sm text-gray-600">{stat.label}</div>
            </div>
          ))}
        </motion.div>
      </div>
    </div>
  );
};

export default HeroPage;
