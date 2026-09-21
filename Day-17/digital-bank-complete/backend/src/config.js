import 'dotenv/config';
export const config = {
  port: Number(process.env.PORT || 5000),
  jwtSecret: process.env.JWT_SECRET,
  jwtExpiresIn: process.env.JWT_EXPIRES_IN || '8h',
  db: { host: process.env.DB_HOST || 'localhost', port: Number(process.env.DB_PORT || 3306), database: process.env.MYSQL_DATABASE || 'digital_bank', username: process.env.MYSQL_USER || 'bankuser', password: process.env.MYSQL_PASSWORD || '' }
};
if (!config.jwtSecret) throw new Error('JWT_SECRET is required');
