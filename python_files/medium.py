file = open("Caffeine.txt","r")
contents = file.read().splitlines()
file.close()



print(contents)