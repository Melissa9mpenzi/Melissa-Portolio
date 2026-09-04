# Melissa Sharon Lokoroma - Portfolio Website

A modern, responsive portfolio website built with Next.js, React, TypeScript, and Tailwind CSS. Designed to showcase my web development experience, projects, and skills.

![Next.js](https://img.shields.io/badge/Next.js-15.1.6-black?style=flat-square&logo=next.js)
![React](https://img.shields.io/badge/React-19-blue?style=flat-square&logo=react)
![TypeScript](https://img.shields.io/badge/TypeScript-5.0-blue?style=flat-square&logo=typescript)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.4-38bdf8?style=flat-square&logo=tailwind-css)

## ✨ Features

- **Modern Design**: Clean, professional UI with smooth animations and transitions
- **Fully Responsive**: Optimized for all devices - mobile, tablet, and desktop
- **Dark Mode Support**: Automatic dark/light theme based on system preferences
- **CV Download**: Downloadable PDF resume
- **Contact Form**: Functional contact form with validation and API endpoint
- **Project Showcase**: Featured projects and website portfolio
- **SEO Optimized**: Meta tags and semantic HTML for better search visibility
- **Fast Performance**: Optimized builds with Next.js 15 and Turbopack
- **Vercel Ready**: Pre-configured for seamless deployment

## 🚀 Tech Stack

- **Framework**: Next.js 15 (App Router)
- **Language**: TypeScript
- **Styling**: Tailwind CSS
- **Icons**: React Icons
- **Animations**: Framer Motion
- **Deployment**: Vercel

## 📦 Project Structure

```
portfolio/
├── app/
│   ├── api/
│   │   └── contact/
│   │       └── route.ts          # Contact form API endpoint
│   ├── globals.css               # Global styles
│   ├── layout.tsx                # Root layout with metadata
│   └── page.tsx                  # Home page
├── components/
│   ├── About.tsx                 # About section
│   ├── Contact.tsx               # Contact form component
│   ├── Experience.tsx            # Work experience & education
│   ├── Footer.tsx                # Footer component
│   ├── Hero.tsx                  # Hero/landing section
│   ├── Navbar.tsx                # Navigation bar
│   ├── Projects.tsx              # Projects showcase
│   └── Skills.tsx                # Technical skills
├── public/
│   └── Melissa_Sharon_Lokoroma_CV.pdf  # Downloadable CV
├── .env.example                  # Environment variables template
├── next.config.ts                # Next.js configuration
├── tailwind.config.ts            # Tailwind CSS configuration
├── tsconfig.json                 # TypeScript configuration
├── vercel.json                   # Vercel deployment config
└── package.json                  # Dependencies
```

## 🛠️ Installation & Setup

### Prerequisites

- Node.js 18+ and npm installed
- Git installed

### Local Development

1. **Clone the repository**
   ```bash
   git clone https://github.com/Melissa9mpenzi/portfolio.git
   cd portfolio
   ```

2. **Install dependencies**
   ```bash
   npm install
   ```

3. **Run the development server**
   ```bash
   npm run dev
   ```

4. **Open your browser**
   Navigate to [http://localhost:3000](http://localhost:3000)

### Build for Production

```bash
npm run build
npm start
```

## 🌐 Deploy to Vercel

### Method 1: Deploy via Vercel Dashboard (Recommended)

1. **Push your code to GitHub**
   ```bash
   git init
   git add .
   git commit -m "Initial commit - Portfolio website"
   git branch -M main
   git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
   git push -u origin main
   ```

2. **Import to Vercel**
   - Go to [vercel.com](https://vercel.com)
   - Click "Add New" → "Project"
   - Import your GitHub repository
   - Vercel will auto-detect Next.js settings
   - Click "Deploy"

3. **Configure Environment Variables (Optional)**
   If you want email notifications from the contact form:
   - Go to Project Settings → Environment Variables
   - Add your email service credentials (see `.env.example`)

### Method 2: Deploy via Vercel CLI

1. **Install Vercel CLI**
   ```bash
   npm install -g vercel
   ```

2. **Login to Vercel**
   ```bash
   vercel login
   ```

3. **Deploy**
   ```bash
   vercel
   ```

4. **Deploy to Production**
   ```bash
   vercel --prod
   ```

## 📧 Contact Form Setup (Optional)

The contact form currently logs submissions to the console. To enable email notifications:

1. **Choose an email service** (SendGrid, Resend, or EmailJS recommended)

2. **For SendGrid**:
   ```bash
   npm install @sendgrid/mail
   ```
   
   Update `app/api/contact/route.ts`:
   ```typescript
   import sgMail from '@sendgrid/mail';
   
   sgMail.setApiKey(process.env.SENDGRID_API_KEY!);
   
   await sgMail.send({
     to: 'melissampenzi@gmail.com',
     from: process.env.SENDGRID_FROM_EMAIL!,
     subject: `Portfolio Contact: ${subject}`,
     text: `Name: ${name}\nEmail: ${email}\n\nMessage:\n${message}`,
   });
   ```

3. **Add environment variables**:
   Create `.env.local`:
   ```
   SENDGRID_API_KEY=your_api_key_here
   SENDGRID_FROM_EMAIL=melissampenzi@gmail.com
   ```

4. **Add to Vercel**:
   Go to Project Settings → Environment Variables and add the same variables

## 🎨 Customization

### Update Personal Information

- **Hero Section**: Edit `components/Hero.tsx`
- **About Me**: Edit `components/About.tsx`
- **Experience**: Edit `components/Experience.tsx`
- **Skills**: Edit `components/Skills.tsx`
- **Projects**: Edit `components/Projects.tsx`
- **Contact Info**: Edit `components/Contact.tsx` and `components/Footer.tsx`

### Change Colors

Edit `tailwind.config.ts`:
```typescript
colors: {
  primary: '#3b82f6',    // Change to your preferred color
  secondary: '#8b5cf6',
  accent: '#ec4899',
},
```

### Replace CV

Replace the file at `public/Melissa_Sharon_Lokoroma_CV.pdf` with your own PDF

## 📱 Sections

1. **Hero** - Landing section with name, title, and CTA buttons
2. **About** - Professional summary and key stats
3. **Skills** - Technical skills with icons organized by category
4. **Experience** - Work history and education timeline
5. **Projects** - Featured projects and website portfolio
6. **Contact** - Contact form and direct contact information

## 🔧 Scripts

```bash
npm run dev      # Start development server
npm run build    # Build for production
npm start        # Start production server
npm run lint     # Run ESLint
```

## 🌟 Features in Detail

### Responsive Navigation
- Sticky navbar with scroll effects
- Mobile-friendly hamburger menu
- Smooth scroll to sections

### Interactive Animations
- Fade-in effects on page load
- Hover animations on cards and buttons
- Smooth transitions throughout

### Optimized Performance
- Server-side rendering with Next.js
- Optimized images and assets
- Minimal bundle size with tree-shaking

### Accessibility
- Semantic HTML structure
- ARIA labels where needed
- Keyboard navigation support
- High contrast text for readability

## 📄 License

This project is open source and available for personal use. Feel free to fork and customize for your own portfolio!

## 📞 Contact

**Melissa Sharon Lokoroma**
- Email: melissampenzi@gmail.com
- GitHub: [@Melissa9mpenzi](https://github.com/Melissa9mpenzi)
- LinkedIn: [Melissa Sharon Lokoroma](https://www.linkedin.com/in/melissa-sharon-lokoroma-aa8681316/)

---

Built with ❤️ using Next.js and Tailwind CSS
