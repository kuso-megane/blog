<?php

use domain\components\breadCrumb\RepositoryPort\SearchedCategoryRepositoryPort;
use domain\components\breadCrumb\RepositoryPort\SearchedSubCategoryRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\CategoryArtclCountRepositoryPort;
use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\SubCategoryArtclCountRepositoryPort;

use infra\Repository\ArticleRepository;
use infra\Repository\SubCategoryRepository;
use infra\Repository\CategoryRepository;



return [
    RecentArtclInfosRepositoryPort::class => \DI\create(ArticleRepository::class),
    CategoryArtclCountRepositoryPort::class => \DI\create(CategoryRepository::class),
    SubCategoryArtclCountRepositoryPort::class => \DI\create(SubCategoryRepository::class),
    SearchedCategoryRepositoryPort::class => \DI\create(CategoryRepository::class),
    SearchedSubCategoryRepositoryPort::class => \DI\create(SubCategoryRepository::class)
];