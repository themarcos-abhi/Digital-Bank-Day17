import { Sequelize, DataTypes } from 'sequelize';
import { config } from './config.js';
export const sequelize = new Sequelize(config.db.database, config.db.username, config.db.password, { host: config.db.host, port: config.db.port, dialect: 'mysql', logging: false });

export const User = sequelize.define('User', {
  id: { type: DataTypes.INTEGER.UNSIGNED, autoIncrement: true, primaryKey: true },
  fullName: { type: DataTypes.STRING(100), allowNull: false }, email: { type: DataTypes.STRING(150), allowNull: false, unique: true },
  phone: { type: DataTypes.STRING(20), allowNull: false, unique: true }, username: { type: DataTypes.STRING(50), allowNull: false, unique: true },
  passwordHash: { type: DataTypes.STRING(255), allowNull: false }, dateOfBirth: DataTypes.DATEONLY, gender: DataTypes.STRING(30),
  identityLast4: DataTypes.STRING(4), address: DataTypes.STRING(255), city: DataTypes.STRING(80), state: DataTypes.STRING(80), pinCode: DataTypes.STRING(12), occupation: DataTypes.STRING(100), annualIncome: DataTypes.DECIMAL(15,2), role: { type: DataTypes.ENUM('customer','admin'), defaultValue: 'customer' }, status: { type: DataTypes.ENUM('active','inactive'), defaultValue: 'active' }
}, { tableName: 'users' });
export const Account = sequelize.define('Account', { id:{type:DataTypes.INTEGER.UNSIGNED,autoIncrement:true,primaryKey:true}, accountNumber:{type:DataTypes.STRING(20),allowNull:false,unique:true}, type:{type:DataTypes.ENUM('savings','personal'),defaultValue:'savings'}, balance:{type:DataTypes.DECIMAL(15,2),defaultValue:0}, status:{type:DataTypes.ENUM('active','blocked'),defaultValue:'active'} }, {tableName:'accounts'});
export const Transaction = sequelize.define('Transaction', { id:{type:DataTypes.INTEGER.UNSIGNED,autoIncrement:true,primaryKey:true}, reference:{type:DataTypes.STRING(40),allowNull:false,unique:true}, type:{type:DataTypes.ENUM('deposit','withdrawal','transfer'),allowNull:false}, amount:{type:DataTypes.DECIMAL(15,2),allowNull:false}, description:DataTypes.STRING(255), status:{type:DataTypes.ENUM('completed','failed','pending'),defaultValue:'completed'} }, {tableName:'transactions'});
export const Card = sequelize.define('Card', { id:{type:DataTypes.INTEGER.UNSIGNED,autoIncrement:true,primaryKey:true}, maskedNumber:{type:DataTypes.STRING(19),allowNull:false}, type:{type:DataTypes.ENUM('debit','credit','virtual'),defaultValue:'debit'}, expiry:{type:DataTypes.STRING(5),allowNull:false}, status:{type:DataTypes.ENUM('active','frozen'),defaultValue:'active'}, dailyLimit:{type:DataTypes.DECIMAL(12,2),defaultValue:50000} }, {tableName:'cards'});
User.hasMany(Account,{foreignKey:{name:'userId',allowNull:false}}); Account.belongsTo(User,{foreignKey:'userId'});
Account.hasMany(Transaction,{foreignKey:{name:'accountId',allowNull:false}}); Transaction.belongsTo(Account,{foreignKey:'accountId'});
User.hasMany(Card,{foreignKey:{name:'userId',allowNull:false}}); Card.belongsTo(User,{foreignKey:'userId'});
