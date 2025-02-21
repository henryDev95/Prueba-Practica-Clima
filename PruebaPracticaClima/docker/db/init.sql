-- Create user if not exists
DO
$do$
BEGIN
   IF NOT EXISTS (SELECT FROM pg_roles WHERE rolname = 'user_clima') THEN
CREATE ROLE user_clima WITH LOGIN PASSWORD 'clima';
END IF;
END
$do$;

-- Create database if not exists
DO
$do$
BEGIN
   IF NOT EXISTS (SELECT FROM pg_database WHERE datname = 'clima') THEN
      CREATE DATABASE clima OWNER user_clima;
END IF;
END
$do$;

-- Grant permissions
GRANT ALL PRIVILEGES ON DATABASE clima TO user_clima;
ALTER DATABASE clima OWNER TO user_clima;
