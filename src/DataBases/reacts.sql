CREATE OR REPLACE TABLE reacts (
    Post_ID INT ,
    User_ID INT,
    PRIMARY KEY (Post_ID, User_ID)
);