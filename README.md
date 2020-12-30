# Vuosaari
URL shortening service made with PHP. Got name in random Discord call. Program
was also made in Discord call.

## Setup

Clone this repository with command `git clone
https://github.com/kaikkitietokoneista/Vuosaari.git` Copy `defconfig.php` to
`config.php` and set correct variables.

Run this command in MySQL console:

```sql
CREATE TABLE vuosaari_urls (
  id VARCHAR(128) PRIMARY KEY,
  url TEXT NOT NULL,
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  ip VARCHAR(15)
)
```
