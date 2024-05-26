#!/usr/bin/env bash


sudo docker compose up -d                

aws dynamodb create-table --table-name sessions \
                          --attribute-definitions AttributeName=id,AttributeType=S  \
                          --key-schema AttributeName=id,KeyType=HASH  \
                          --billing-mode PAY_PER_REQUEST \
                          --endpoint-url http://localhost:8000