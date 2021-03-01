<?php

use domain\search\index\RepositoryPort\RecentArtclInfosRepositoryPort;
use infra\Repository\RecentArtclInfosRepository;

use domain\components\mainSidebar\RepositoryPort\CategorySearchListRepositoryPort;
use infra\Repository\CategorySearchListRepository;




return [
    RecentArtclInfosRepositoryPort::class => \DI\create(RecentArtclInfosRepository::class),

    CategorySearchListRepositoryPort::class => \DI\create(CategorySearchListRepository::class)
];