import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "Melissa Sharon Lokoroma | Web Solutions Developer & Software Engineer",
  description: "Portfolio of Melissa Sharon Lokoroma - Web Solutions Developer with 4+ years of experience in WordPress, React, Python, and modern web technologies.",
  keywords: "Web Developer, Software Engineer, React, Next.js, WordPress, Python, Django, Frontend Developer, UI/UX",
  authors: [{ name: "Melissa Sharon Lokoroma" }],
  openGraph: {
    title: "Melissa Sharon Lokoroma | Web Solutions Developer",
    description: "Portfolio showcasing web development projects and expertise",
    type: "website",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body className={inter.className}>
        <Navbar />
        <main className="min-h-screen">
          {children}
        </main>
        <Footer />
      </body>
    </html>
  );
}
