CREATE OR REPLACE TABLE report (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(64),
    email VARCHAR(64),
    message VARCHAR(256),
    date DATETIME
);
