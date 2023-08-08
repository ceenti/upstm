import React from "react";
import { MainLayout } from "../Components/Layouts";

import "@webdeveducation/wp-block-tools/dist/css/style.css";

const Single = (props) => {
  const { featured_image, title, content } = props;
  return (
    <MainLayout>
      <article className="prose prose-xl mx-auto">
        <img src={featured_image} alt={title} />
        <h1>{title}</h1>
        <div dangerouslySetInnerHTML={{ __html: content }}></div>
      </article>
    </MainLayout>
  );
};

export default Single;
