#!/bin/sh

targetPath="../www/html/asset/stylesheet/"

sass search/search.scss ${targetPath}search/search.css
sass article/show.scss ${targetPath}article/show.css
sass backyard/article.scss ${targetPath}backyard/article.css
