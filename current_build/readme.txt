#!/bin/bash

# Get the local IP address using the 'hostname' command
local_ip=$(hostname -I | awk '{print $1}')

# Open Firefox with the search URL using the local IP
firefox "https://www.google.com/search?q=$local_ip"
