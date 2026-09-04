"use client";

import { motion } from "framer-motion";
import { FaExternalLinkAlt } from "react-icons/fa";

const WebsitesPage = () => {
  const websites = [
    { name: "Lwegatech", url: "http://lwegatech.com/" },
    { name: "Jambo App", url: "https://jamboapp.io/" },
    { name: "Bora Pharma", url: "https://borapharma.cloud/" },
    { name: "Bora Invoice", url: "https://borainvoice.cloud/" },
    { name: "Bora POS", url: "https://borapos.cloud/" },
    { name: "ABC Capital Bank", url: "https://abccapitalbank.co.ug/" },
    { name: "UEGCL", url: "https://uegcl.com/" },
    { name: "Honorable Vessels Online Connect", url: "https://honorablevesselsonlineconnect.org/" },
    { name: "Hopeline Action Uganda", url: "https://hopelineactionuganda.org/" },
    { name: "Dialus Tours and Travel", url: "https://dialustoursandtravel.com/" },
    { name: "Coronation Developers", url: "#" },
    { name: "Aliyah Orphanage", url: "https://aliyahorphanage.org/" },
    { name: "Alpha East Africa", url: "https://alphaeastafrica.com/" },
    { name: "The Traveler Portal", url: "https://thetravelerportal.com/" },
    { name: "Dialus Logistics", url: "https://dialuslogistics.com/" },
    { name: "Kasenga Realty", url: "https://lwegatech.net/kasenga-realty/" },
    { name: "256 Youth Platform", url: "https://256youthplatform.org/" },
    { name: "Libertyscope", url: "https://libertyscope.co.ug/" },
    { name: "Ngazi Arts", url: "http://ngaziarts.com/" },
  ];

  return (
    <div className="h-full p-8 sm:p-16 bg-gradient-to-br from-green-50 via-cyan-50 to-blue-50 overflow-y-auto">
      <motion.h2
        initial={{ y: -30, opacity: 0 }}
        animate={{ y: 0, opacity: 1 }}
        className="text-4xl sm:text-5xl font-bold mb-4 text-center bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent"
      >
        Website Portfolio
      </motion.h2>

      <motion.p
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ delay: 0.2 }}
        className="text-center text-gray-600 mb-8"
      >
        Professional websites I&apos;ve designed, developed, and deployed
      </motion.p>

      <div className="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        {websites.map((site, index) => (
          <motion.a
            key={index}
            href={site.url}
            target="_blank"
            rel="noopener noreferrer"
            initial={{ scale: 0, rotate: -180 }}
            animate={{ scale: 1, rotate: 0 }}
            transition={{
              delay: 0.3 + index * 0.05,
              type: "spring",
              stiffness: 150,
            }}
            whileHover={{
              scale: 1.05,
              y: -5,
              boxShadow: "0 20px 40px rgba(0,0,0,0.15)",
            }}
            className="group bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg flex items-center justify-between cursor-pointer border border-gray-100"
          >
            <span className="text-sm font-semibold text-gray-700 group-hover:text-purple-600 transition-colors">
              {site.name}
            </span>
            <FaExternalLinkAlt className="text-gray-400 group-hover:text-purple-600 transition-colors" size={14} />
          </motion.a>
        ))}
      </div>

      <motion.div
        initial={{ y: 30, opacity: 0 }}
        animate={{ y: 0, opacity: 1 }}
        transition={{ delay: 1 }}
        className="max-w-5xl mx-auto mt-8 bg-gradient-to-r from-purple-500/10 to-blue-500/10 rounded-2xl p-6 text-center"
      >
        <p className="text-lg font-semibold text-gray-800">
          <span className="text-3xl font-bold text-purple-600">{websites.length}</span> Professional Websites Delivered
        </p>
        <p className="text-sm text-gray-600 mt-2">
          Each project built with attention to detail, performance, and user experience
        </p>
      </motion.div>
    </div>
  );
};

export default WebsitesPage;
