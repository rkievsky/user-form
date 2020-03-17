FROM nginx

ARG NGINX_UID
ARG NGINX_GID
ARG CONFIG_PATH

ARG SITE_PATH
ARG FPM_SOCKET_PATH

RUN rm $CONFIG_PATH/conf.d/*; mkdir -p $FPM_SOCKET_PATH $SITE_PATH; \
    groupmod -g $NGINX_UID nginx && usermod -u $NGINX_UID -g $NGINX_GID nginx

COPY conf.d/* $CONFIG_PATH/conf.d/

WORKDIR $SITE_PATH

# для отладки образа
# CMD /bin/bash
# ENTRYPOINT /bin/bash