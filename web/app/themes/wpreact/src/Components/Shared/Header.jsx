import React from "react";
import { Link } from "@inertiajs/inertia-react";

export const Header = () => {
  return (
    <header className="sticky top-0 bg-white">
      <div className="container flex justify-between p-5 mx-auto">
        <Link href="/">LOGO</Link>
        <nav className="flex items-center gap-3">
          <Link href="/blog">Blog</Link>
        </nav>
      </div>
    </header>
  );
};
