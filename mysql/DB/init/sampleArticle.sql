START TRANSACTION;
INSERT INTO Article VALUES(0, 1, 1, "サンプル記事1", "default.jpg", "<p>サンプル記事1です。</p>", NULL);
INSERT INTO Article VALUES(0, 1, 1, "サンプル記事2", "default.jpg", "<p>サンプル記事2です。</p>", NULL);
INSERT INTO Article VALUES(0, 1, 1, "サンプル記事3", "default.jpg", "<p>サンプル記事3です。</p>", NULL);
INSERT INTO Article VALUES(0, 1, 1, "サンプル記事4", "default.jpg", "<p>サンプル記事4です。</p>", NULL);
UPDATE Category SET num = num + 4 WHERE id = 1;
UPDATE SubCategory SET num = num + 4 WHERE id = 1;
COMMIT;
