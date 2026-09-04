import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  // Optimized for Vercel deployment
  images: {
    unoptimized: true,
  },
  // Enable React strict mode for better development experience
  reactStrictMode: true,
  // Optimize build output
  swcMinify: true,
};

export default nextConfig;
