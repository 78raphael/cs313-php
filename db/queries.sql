CREATE TABLE users  (
  id int SERIAL PRIMARY KEY,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(50) NOT NULL,
  status status_type,
  active BOOLEAN DEFAULT false,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL,
);

CREATE TYPE status_type AS ENUM ('active','on hold','deactive','archived');
CREATE TABLE sessions (
  id int SERIAL PRIMARY KEY,
  name varchar(75) NOT NULL,
  description varchar DEFAULT NULL,
  image varchar(100) DEFAULT NULL,
  price float DEFAULT NULL,
  status status_type,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL,
);

CREATE TYPE status_type AS ENUM ('archived','pending','requested','in progress');
CREATE TABLE appointments (
  id int SERIAL NOT NULL PRIMARY KEY,
  user_id int NOT NULL,
  session_id int NOT NULL,
  appt_time timestamp NULL DEFAULT NULL,
  status status_type,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (session_id) REFERENCES sessions(id)
);

CREATE TABLE reviews (
  id int SERIAL PRIMARY KEY,
  session_id int NOT NULL,
  user_id int NOT NULL,
  notes text,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (session_id) REFERENCES sessions(id)
);
