FROM mysql:5.6

# 初始化SQL文件（容器启动时自动执行）
COPY ./data/db.sql /docker-entrypoint-initdb.d/

# 自定义Entrypoint脚本（需包含原始MySQL启动逻辑）
COPY ./service/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# MySQL配置文件
COPY ./config/mysqld.cnf /etc/mysql/mysql.conf.d/

# 设置环境变量
ENV MYSQL_ALLOW_EMPTY_PASSWORD=yes

# 暴露端口
EXPOSE 3306

# 使用自定义Entrypoint（需确保兼容MySQL启动流程）
ENTRYPOINT ["docker-entrypoint.sh"]

# 继承基础镜像CMD
CMD ["mysqld"]