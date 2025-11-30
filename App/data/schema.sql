-- drop database jawan_blog;

CREATE DATABASE IF NOT EXISTS jawan_blog;
USE jawan_blog;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role CHAR(30) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(150) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    picture_path VARCHAR(255),
    job_title VARCHAR(100),
    bio TEXT,
    facebook_link VARCHAR(255),
    x_link VARCHAR(255),
    github_link VARCHAR(255),
    website_link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Posts table
CREATE TABLE IF NOT EXISTS posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    url_slug VARCHAR(150) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    author_id INT UNSIGNED NOT NULL,
    x_minutes_read INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    category VARCHAR(100),
    tags LONGTEXT,
    content TEXT NOT NULL,
    cover_image VARCHAR(255),
    FOREIGN KEY (author_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Comments table
CREATE TABLE IF NOT EXISTS comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Newsletter subscribers table
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    subscriber_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    full_name VARCHAR(100),
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- INSERT INTO users (user_id, username, user_name, picture_path, job_title, bio, facebook_link, x_link, github_link, website_link)
-- VALUES
--     (UUID(), 'jdoe', 'John Doe', '/images/user-1.png', 'Software Engineer', 'Writes about PHP and MySQL.', 'https://facebook.com/x', 'https://x.com/x', 'https://github.com/x', 'https://x.dev'),
--     (UUID(), 'asmith', 'Alice Smith', '/images/user-2.png', 'Web Developer', 'Explores creative web projects.', 'https://facebook.com/x', 'https://x.com/x', 'https://github.com/x', 'https://x.dev'),
--     (UUID(), 'bking', 'Bob King', '/images/user-3.png', 'Data Analyst', 'Loves food and analytics.', 'https://facebook.com/x', 'https://x.com/x', 'https://github.com/x', 'https://x.dev'),
--     (UUID(), 'cwhite', 'Clara White', '/images/user-4.png', 'Designer', 'Passionate about creativity and design.', 'https://facebook.com/x', 'https://x.com/x', 'https://github.com/x', 'https://x.dev'),
--     (UUID(), 'dgreen', 'David Green', '/images/user-5.png', 'Videographer', 'Creates vlogs and videography content.', 'https://facebook.com/x', 'https://x.com/x', 'https://github.com/x', 'https://x.dev'),
--     (UUID(), 'emartin', 'Emma Martin', '/images/user-6.png', 'Chef Blogger', 'Writes tasty recipes and food blogs.', 'https://facebook.com/x', 'https://x.com/x', 'https://github.com/x', 'https://x.dev');

-- INSERT INTO posts (url_slug, title, author_id, x_minutes_read, category, tags, content, cover_image)
-- VALUES
--     ('creative-city', 'Exploring Creative City Ideas',
--         (SELECT user_id FROM users WHERE username='cwhite'),
--         5, 'Creativity', JSON_ARRAY('City','Creative','Decorate'),
--         'A post about creative city designs and decorations.', '/covers/creative-city.png'),

--     ('food-recipe-wow', 'Wow Recipes for Food Lovers',
--         (SELECT user_id FROM users WHERE username='emartin'),
--         6, 'Food', JSON_ARRAY('Food','Recipe','Wow'),
--         'Delicious recipes that will wow your taste buds.', '/covers/food-recipe-wow.png'),

--     ('demo-elements', 'Demo of Web Elements',
--         (SELECT user_id FROM users WHERE username='asmith'),
--         4, 'Demo', JSON_ARRAY('Demo','Elements','Nice'),
--         'A demo showcasing modern web elements.', '/covers/demo-elements.png'),

--     ('taste-season', 'Taste the Season',
--         (SELECT user_id FROM users WHERE username='bking'),
--         7, 'Season', JSON_ARRAY('Taste','Season','Tasty'),
--         'Exploring seasonal tastes and recipes.', '/covers/taste-season.png'),

--     ('vlog-videography', 'Starting a Videography Vlog',
--         (SELECT user_id FROM users WHERE username='dgreen'),
--         8, 'Videography', JSON_ARRAY('Vlog','Videography','Creative'),
--         'Tips for starting your own videography vlog.', '/covers/vlog-videography.png'),

--     ('tech-elements', 'Tech Elements in Design',
--         (SELECT user_id FROM users WHERE username='jdoe'),
--         5, 'Tech', JSON_ARRAY('Tech','Elements','Color'),
--         'Discussing how tech influences design elements.', '/covers/tech-elements.png'),

--     ('natural-fish', 'Natural Fish Recipes',
--         (SELECT user_id FROM users WHERE username='emartin'),
--         6, 'Natural', JSON_ARRAY('Fish','Food','Recipe'),
--         'Healthy natural recipes featuring fish.', '/covers/natural-fish.png'),

--     ('newyork-wow', 'Wow Moments in Newyork City',
--         (SELECT user_id FROM users WHERE username='cwhite'),
--         7, 'Newyork city', JSON_ARRAY('City','Wow','Nice'),
--         'Capturing wow moments in Newyork City.', '/covers/newyork-wow.png'),

--     ('microwave-demo', 'Microwave Cooking Demo',
--         (SELECT user_id FROM users WHERE username='emartin'),
--         4, 'Microwave', JSON_ARRAY('Demo','Food','Recipe'),
--         'Quick microwave cooking demos for busy people.', '/covers/microwave-demo.png'),

--     ('wondarland-creative', 'Creative Wondarland Ideas',
--         (SELECT user_id FROM users WHERE username='cwhite'),
--         6, 'Wondarland', JSON_ARRAY('Creative','Decorate','Wow'),
--         'Exploring creative ideas for a wondarland theme.', '/covers/wondarland-creative.png'),('city-color-demo', 'City Colors Demo',
--         (SELECT user_id FROM users WHERE username='jdoe'),
--         5, 'Demo', JSON_ARRAY('City','Color','Demo'),
--         'Exploring how city colors can be showcased in demo projects.', '/covers/city-color-demo.png'),

--     ('creative-elements', 'Creative Elements in Design',
--         (SELECT user_id FROM users WHERE username='cwhite'),
--         6, 'Creativity', JSON_ARRAY('Creative','Elements','Wow'),
--         'Discussing creative elements that inspire design.', '/covers/creative-elements.png'),

--     ('food-tasty-recipe', 'Tasty Food Recipes',
--         (SELECT user_id FROM users WHERE username='emartin'),
--         7, 'Food', JSON_ARRAY('Food','Recipe','Tasty'),
--         'Sharing tasty recipes for food lovers.', '/covers/food-tasty-recipe.png'),

--     ('videography-vlog-wow', 'Videography Vlog Wow Moments',
--         (SELECT user_id FROM users WHERE username='dgreen'),
--         8, 'Videography', JSON_ARRAY('Vlog','Wow','Videography'),
--         'Capturing wow moments in videography vlogs.', '/covers/videography-vlog-wow.png'),

--     ('natural-season-taste', 'Natural Seasonal Tastes',
--         (SELECT user_id FROM users WHERE username='bking'),
--         6, 'Natural', JSON_ARRAY('Season','Taste','Nice'),
--         'Exploring natural seasonal tastes and flavors.', '/covers/natural-season-taste.png'),

--     ('tech-decorate-elements', 'Tech Decorate Elements',
--         (SELECT user_id FROM users WHERE username='asmith'),
--         5, 'Tech', JSON_ARRAY('Tech','Decorate','Elements'),
--         'How technology helps decorate and enhance design elements.', '/covers/tech-decorate-elements.png'),

--     ('microwave-food-demo', 'Microwave Food Demo',
--         (SELECT user_id FROM users WHERE username='emartin'),
--         4, 'Microwave', JSON_ARRAY('Microwave','Food','Demo'),
--         'Quick microwave food demos for busy kitchens.', '/covers/microwave-food-demo.png'),

--     ('newyork-vlog-city', 'Newyork City Vlog',
--         (SELECT user_id FROM users WHERE username='dgreen'),
--         7, 'Newyork city', JSON_ARRAY('City','Vlog','Wow'),
--         'A vlog capturing life in Newyork City.', '/covers/newyork-vlog-city.png'),

--     ('wondarland-creative-taste', 'Creative Wondarland Taste',
--         (SELECT user_id FROM users WHERE username='cwhite'),
--         6, 'Wondarland', JSON_ARRAY('Creative','Taste','Tasty'),
--         'Creative wondarland ideas with tasty inspirations.', '/covers/wondarland-creative-taste.png'),

--     ('nice-fish-recipe', 'Nice Fish Recipe',
--         (SELECT user_id FROM users WHERE username='bking'),
--         5, 'Nice', JSON_ARRAY('Fish','Recipe','Nice'),
--         'A nice recipe featuring fresh fish.', '/covers/nice-fish-recipe.png');