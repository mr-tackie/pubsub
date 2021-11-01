curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:9000/hello"}' http://localhost:3000/subscribe/topic1
curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:9000/pangaea"}' http://localhost:3000/subscribe/topic2
curl -X POST -H "Content-Type: application/json" -d '{"message": "This is a message from topic 1"}' http://localhost:3000/publish/topic1
curl -X POST -H "Content-Type: application/json" -d '{"message": "This is a message from topic 2"}' http://localhost:3000/publish/topic2