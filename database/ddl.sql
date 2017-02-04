CREATE TABLE IF NOT EXISTS contacts (
    id INTEGER PRIMARY KEY,
    name TEXT,
    email TEXT,
    mobile TEXT,
    phone TEXT
);

CREATE TABLE IF NOT EXISTS sales (
    id INTEGER PRIMARY KEY,
    done_at INTEGER,
    value REAL,
    contact_id INTEGER
);

CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY,
    name TEXT,
    value REAL
);

CREATE TABLE IF NOT EXISTS sales_items (
    id INTEGER PRIMARY KEY,
    value REAL,
    quantity INTEGER,
    sale_id INTEGER,
    product_id INTEGER
);