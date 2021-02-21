CREATE DATABASE life_coach;

CREATE TYPE user_status_type AS ENUM ('admin', 'client', 'basic', 'guest');
CREATE TABLE users  (
  id SERIAL PRIMARY KEY,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(50) NOT NULL,
  status user_status_type,
  active BOOLEAN DEFAULT false,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL
);

CREATE TYPE session_status_type AS ENUM ('active','on hold','deactive','archived');
CREATE TABLE sessions (
  id SERIAL PRIMARY KEY,
  name varchar(75) NOT NULL,
  description varchar DEFAULT NULL,
  image varchar(100) DEFAULT NULL,
  price float DEFAULT NULL,
  status session_status_type,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL
);

CREATE TYPE appointment_status_type AS ENUM ('archived','pending','requested','in progress');
CREATE TABLE appointments (
  id SERIAL NOT NULL PRIMARY KEY,
  user_id int NOT NULL,
  session_id int NOT NULL,
  appt_time timestamp NULL DEFAULT NULL,
  status appointment_status_type,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (session_id) REFERENCES sessions(id)
);

CREATE TABLE reviews (
  id SERIAL PRIMARY KEY,
  appointment_id int NOT NULL,
  notes text,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL,
  FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE
);



INSERT INTO users (id, first_name, last_name, username, password, email, status, active, created_at, updated_at)
VALUES
	(1, 'Han', 'Solo', 'Chewy', 'password', 'hansolo@email.com', 'client', true, '2021-02-06 20:42:25', '2021-02-06 20:42:25'),
	(2, 'Stephen', 'Strange', 'Doctor', 'password', 'doctor@strange.com', 'guest', true, '2021-02-06 20:42:51', '2021-02-06 20:42:51'),
	(3, 'Bruce', 'Banner', 'hulkOut', 'password', 'doctor@hulk.com', 'guest', true, '2021-02-06 20:43:42', '2021-02-06 20:43:42'),
	(4, 'Administrator', 'User', 'admin', 'admin', 'admin@email.com', 'admin', true, '2021-02-06 20:44:00', '2021-02-06 20:44:00');
  (5, 'Justin', 'Pierre', 'mcs1', 'mcs1', 'justin@mcs.com', 'guest', true, '2021-02-06 20:44:00', '2021-02-06 20:44:00');


INSERT INTO sessions (id, name, description, image, price, status, created_at, updated_at)
VALUES
	(1, 'Anger Management', 'Gain control of your anger issues and responses.', NULL, 100, 'active', '2021-02-06 20:45:23', '2021-02-06 20:45:23'),
	(2, 'Time Management', 'Learn how to manage and structure your day.', NULL, 150, 'active', '2021-02-06 20:46:28', '2021-02-06 20:46:28'),
	(3, 'Hunger Management', 'Learn how to manage all eating and non-eating impulses', NULL, 150, 'active', '2021-02-06 20:47:20', '2021-02-06 20:47:20');


INSERT INTO appointments (id, user_id, session_id, appt_time, status, created_at, updated_at)
VALUES
	(1, 1, 2, '2021-02-06 09:00:00', 'requested', '2021-02-06 20:48:40', '2021-02-06 20:48:40'),
	(2, 3, 1, '2021-02-17 10:00:00', 'pending', '2021-02-06 20:52:25', '2021-02-06 20:52:25'),
	(3, 2, 2, '2021-01-31 08:00:00', 'archived', '2021-02-06 20:50:12', '2021-02-06 20:50:12');


INSERT INTO reviews (id, appointment_id, notes, created_at, updated_at)
VALUES
	(1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed molestie est nec porttitor ullamcorper. Pellentesque nulla arcu, aliquam tristique pulvinar vitae, congue faucibus quam. Maecenas in vulputate arcu. Nunc leo arcu, pellentesque quis tempus sit amet, aliquet vestibulum ipsum. Integer gravida laoreet nunc a placerat. In eleifend ex urna, nec viverra nunc semper vel. Nunc eget nibh risus. Curabitur viverra odio ac est mattis pulvinar.', '2021-02-06 20:54:48', '2021-02-06 20:54:48'),
	(2, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed molestie est nec porttitor ullamcorper. Pellentesque nulla arcu, aliquam tristique pulvinar vitae, congue faucibus quam. Maecenas in vulputate arcu. Nunc leo arcu, pellentesque quis tempus sit amet, aliquet vestibulum ipsum. Integer gravida laoreet nunc a placerat. In eleifend ex urna, nec viverra nunc semper vel. Nunc eget nibh risus. Curabitur viverra odio ac est mattis pulvinar. Cras in leo non turpis vehicula feugiat. Pellentesque nec aliquam justo. Ut eros enim, finibus vel ex id, ultrices sollicitudin tellus. Morbi sed sem eu nibh rhoncus hendrerit. Pellentesque nisl purus, aliquet quis tincidunt id, tempor eget ipsum. Proin rhoncus dapibus laoreet.', '2021-02-06 20:55:05', '2021-02-06 20:55:05'),
	(3, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed molestie est nec porttitor ullamcorper. Pellentesque nulla arcu, aliquam tristique pulvinar vitae, congue faucibus quam. Maecenas in vulputate arcu. Nunc leo arcu, pellentesque quis tempus sit amet, aliquet vestibulum ipsum. Integer gravida laoreet nunc a placerat.', '2021-02-06 20:55:24', '2021-02-06 20:55:24');