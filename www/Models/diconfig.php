<?php

use domain\components\mainSidebar\RepositoryPort\CategoryArtclCountRepositoryPort;
use infra\Repository\CategoryRepository;

use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use infra\Repository\RecentArtclInfosRepository;

use domain\components\mainSidebar\RepositoryPort\SubCategoryArtclCountRepositoryPort;
use infra\Repository\SubCategoryRepository;




return [
    RecentArtclInfosRepositoryPort::class => \DI\create(RecentArtclInfosRepository::class),
    CategoryArtclCountRepositoryPort::class => \DI\create(CategoryRepository::class),
    SubCategoryArtclCountRepositoryPort::class => \DI\create(SubCategoryRepository::class)
];