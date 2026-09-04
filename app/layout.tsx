import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";
import { ThemeProvider } from "./providers";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "Melissa Sharon Lokoroma | Software Engineer / Web Solutions Developer",
  description: "Portfolio of Melissa Sharon Lokoroma - Software Engineer and Web Solutions Developer with 4+ years of experience in WordPress, React, Python, and modern web technologies.",
  keywords: "Web Developer, Software Engineer, React, Next.js, WordPress, Python, Django, Frontend Developer, UI/UX",
  authors: [{ name: "Melissa Sharon Lokoroma" }],
  openGraph: {
    title: "Melissa Sharon Lokoroma | Software Engineer / Web Solutions Developer",
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
    <html lang="en" suppressHydrationWarning>
      <body className={inter.className}>
        <ThemeProvider>
          {children}
        </ThemeProvider>
      </body>
    </html>
  );
}
