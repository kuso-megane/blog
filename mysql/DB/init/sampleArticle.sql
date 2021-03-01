START TRANSACTION;
INSERT INTO Article VALUES(0, 1, 1, "サンプル記事", "default.jpg", "<p>サンプル記事です。</p>", NULL);
UPDATE Category SET num = num + 1 WHERE id = 1;
UPDATE SubCategory SET num = num + 1 WHERE id = 1;
COMMIT;
