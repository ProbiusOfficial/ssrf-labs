FROM centos:7
COPY rpm /rpm
RUN cd /rpm && rpm -ivh *.rpm
COPY redis-* /usr/local/bin/
COPY redis.conf /etc/
COPY start.sh /start.sh
RUN chmod -v +x /start.sh \
    && echo "helloct{you_got_flag_27}" > /flag \
    && chmod +x /usr/local/bin/redis-server

EXPOSE 6379
CMD ["/start.sh"]