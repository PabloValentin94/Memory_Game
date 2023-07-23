CREATE USER IF NOT EXISTS "player"@"localhost" IDENTIFIED BY "mgbl";

SELECT * FROM MySQL.user;

-- FLUSH PRIVILEGES;

REVOKE ALL PRIVILEGES, GRANT OPTION FROM "player"@"localhost";

FLUSH PRIVILEGES;

GRANT SELECT ON db_memory_game_bl.* TO "player"@"localhost";

FLUSH PRIVILEGES;

SHOW GRANTS FOR "player"@"localhost";

-- SELECT * FROM MySQL.User WHERE User = "player" and Host = "localhost";

-- DROP USER "player"@"localhost";