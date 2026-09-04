"use client";

import { motion } from "framer-motion";
import { useState, FormEvent } from "react";
import {
  FaEnvelope,
  FaPhone,
  FaMapMarkerAlt,
  FaPaperPlane,
  FaGithub,
  FaLinkedin,
} from "react-icons/fa";

const ContactPage = () => {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    message: "",
  });
  const [status, setStatus] = useState<
    "idle" | "loading" | "success" | "error"
  >("idle");

  const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    setStatus("loading");

    try {
      const response = await fetch("/api/contact", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ ...formData, subject: "Portfolio Contact" }),
      });

      if (response.ok) {
        setStatus("success");
        setFormData({ name: "", email: "", message: "" });
      } else {
        setStatus("error");
      }
    } catch {
      setStatus("error");
    }

    setTimeout(() => setStatus("idle"), 3000);
  };

  return (
    <div className="h-full p-8 sm:p-16 bg-gradient-to-br from-purple-50 via-pink-50 to-orange-50 overflow-y-auto">
      <motion.h2
        initial={{ scale: 0 }}
        animate={{ scale: 1 }}
        className="text-4xl sm:text-5xl font-bold mb-8 text-center bg-gradient-to-r from-purple-600 to-orange-600 bg-clip-text text-transparent"
      >
        Get In Touch
      </motion.h2>

      <div className="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
        {/* Contact Info */}
        <motion.div
          initial={{ x: -50, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          transition={{ delay: 0.2 }}
          className="space-y-4"
        >
          {[
            {
              icon: FaEnvelope,
              label: "Email",
              value: "melissampenzi@gmail.com",
              link: "mailto:melissampenzi@gmail.com",
            },
            {
              icon: FaPhone,
              label: "Phone",
              value: "+256 765 022 499",
              link: "tel:+256765022499",
            },
            {
              icon: FaPhone,
              label: "Phone",
              value: "+256 759 933 134",
              link: "tel:+256759933134",
            },
            {
              icon: FaMapMarkerAlt,
              label: "Location",
              value: "Kampala, Uganda",
              link: null,
            },
          ].map((item, index) => (
            <motion.div
              key={index}
              initial={{ x: -30, opacity: 0 }}
              animate={{ x: 0, opacity: 1 }}
              transition={{ delay: 0.3 + index * 0.1 }}
              whileHover={{ scale: 1.05, x: 10 }}
              className="bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg flex items-start gap-4"
            >
              <div className="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center flex-shrink-0">
                <item.icon className="text-white" size={20} />
              </div>
              <div>
                <p className="text-sm text-gray-500">{item.label}</p>
                {item.link ? (
                  <a
                    href={item.link}
                    className="font-semibold text-gray-800 hover:text-purple-600 transition-colors"
                  >
                    {item.value}
                  </a>
                ) : (
                  <p className="font-semibold text-gray-800">{item.value}</p>
                )}
              </div>
            </motion.div>
          ))}

          {/* Social Links */}
          <motion.div
            initial={{ y: 20, opacity: 0 }}
            animate={{ y: 0, opacity: 1 }}
            transition={{ delay: 0.6 }}
            className="flex gap-4 pt-4"
          >
            <motion.a
              href="https://github.com/Melissa9mpenzi"
              target="_blank"
              rel="noopener noreferrer"
              whileHover={{ scale: 1.2, rotate: 360 }}
              className="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center text-white shadow-lg"
            >
              <FaGithub size={24} />
            </motion.a>
            <motion.a
              href="https://www.linkedin.com/in/melissa-sharon-lokoroma-aa8681316/"
              target="_blank"
              rel="noopener noreferrer"
              whileHover={{ scale: 1.2, rotate: 360 }}
              className="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white shadow-lg"
            >
              <FaLinkedin size={24} />
            </motion.a>
          </motion.div>
        </motion.div>

        {/* Contact Form */}
        <motion.form
          initial={{ x: 50, opacity: 0 }}
          animate={{ x: 0, opacity: 1 }}
          transition={{ delay: 0.4 }}
          onSubmit={handleSubmit}
          className="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-xl space-y-4"
        >
          <input
            type="text"
            placeholder="Your Name"
            value={formData.name}
            onChange={(e) => setFormData({ ...formData, name: e.target.value })}
            required
            className="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
          />
          <input
            type="email"
            placeholder="Your Email"
            value={formData.email}
            onChange={(e) =>
              setFormData({ ...formData, email: e.target.value })
            }
            required
            className="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
          />
          <textarea
            placeholder="Your Message"
            value={formData.message}
            onChange={(e) =>
              setFormData({ ...formData, message: e.target.value })
            }
            required
            rows={4}
            className="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all resize-none"
          />

          {status !== "idle" && (
            <motion.div
              initial={{ opacity: 0, y: -10 }}
              animate={{ opacity: 1, y: 0 }}
              className={`p-3 rounded-lg text-sm ${
                status === "success"
                  ? "bg-green-100 text-green-700"
                  : status === "error"
                    ? "bg-red-100 text-red-700"
                    : "bg-blue-100 text-blue-700"
              }`}
            >
              {status === "success" && "Message sent successfully!"}
              {status === "error" && "Failed to send. Try again."}
              {status === "loading" && "Sending..."}
            </motion.div>
          )}

          <motion.button
            type="submit"
            disabled={status === "loading"}
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
            className="w-full px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg font-semibold flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all disabled:opacity-50"
          >
            <FaPaperPlane />
            <span>{status === "loading" ? "Sending..." : "Send Message"}</span>
          </motion.button>
        </motion.form>
      </div>
    </div>
  );
};

export default ContactPage;
