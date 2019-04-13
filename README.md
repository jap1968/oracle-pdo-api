# Sample PHP RESTful API using oracle-pdo

This is a sample of a RESTful API to access data from Oracle using the PHP language. The code has been built using the [SLIM PHP framework](http://www.slimframework.com/) which is particularly well suited to build APIs.
The project is built as a Docker container image created from the [oracle-pdo](https://github.com/jap1968/base-pdo-oci) base image.

## Useful Docker commands:
First step is to generate the Docker container image from the Dockerfile. Do not forget to create your own `.env` file according to your environment. Otherwise the image creation process will fail.

```sh
$ docker build -t "oracle-pdo-api" .
```
Once you have your container image, you are ready to launch the container:

```sh
$ sudo docker run --rm -d -p 9020:80 oracle-pdo-api
```

Finally, point your browser to the [API url](http://localhost:9020/api/v1/items/player/1). Make the necessary changes (host, port, url, ... ) to fit your particular environment properties.
