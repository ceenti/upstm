import React from "react";
import { MainLayout } from "../Components/Layouts";
import { Link } from "@inertiajs/inertia-react";

const Blog = (props) => {
  const { posts } = props;
  return (
    <MainLayout>
      <div className="container mx-auto px-5">
        <h1 className="text-5xl my-10">Blog</h1>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
          {posts.map((post) => (
            <div className="col-auto" key={`post-${post.id}`}>
              <img src={post.image} alt="blog image" />
              <div className="flex flex-col justify-start items-start">
                <span className="text-xl font-semibold">{post.title}</span>
                <p
                  className="text-sm"
                  dangerouslySetInnerHTML={{ __html: post.excerpt }}
                ></p>
                <div className="flex-1"></div>
                <Link
                  href={post.link}
                  className="px-2 py-2 hover:underline hover:text-blue-500  cursor-pointer"
                >
                  Read more
                </Link>
              </div>
            </div>
          ))}
        </div>
      </div>
    </MainLayout>
  );
};

export default Blog;
