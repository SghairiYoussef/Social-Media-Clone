CREATE OR REPLACE TABLE post (
    Post_ID INT AUTO_INCREMENT PRIMARY KEY,
    Caption VARCHAR(500),
    Date_published DATE DEFAULT CURRENT_DATE() ,
    Media VARCHAR(500),
    React_Count INT DEFAULT 0,
    User_ID INT,
    title VARCHAR(64)
);