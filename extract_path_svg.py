import os;


def detect_word_v2(line,word):
    cut_word = line.split(word,1)
    if(cut_word[0]==line):
        return False
    return True


def search_d(line):
	cut_line = line.split(" d=")
	if(cut_line[0]!=line):
		cut_line_again = cut_line[1].split("\"")
		if(cut_line_again[0] != cut_line[1]):
			return cut_line_again[1]
	return 0

def search_namecountry(line):
	cut_line = line.split(" title=")
	if(cut_line[0]!=line):
		cut_line_again = cut_line[1].split("\"")
		if(cut_line_again[0] != cut_line[1]):
			return cut_line_again[1]
	return 0

def search_idcountry(line):
	cut_line = line.split(" id=")
	if(cut_line[0]!=line):
		cut_line_again = cut_line[1].split("\"")
		if(cut_line_again[0] != cut_line[1]):
			return cut_line_again[1]
	return 0


data_d = []
data_name_c = []
data_ids = []
active_path = 0
active_id = 0
active_country = 0
with open("world_green.svg",'r') as file : 
	lines = file.readlines()
	for l in lines: 
		if(search_d(l)!=0):
			data_d.append(search_d(l))
			active_country = 1
		elif(search_namecountry(l)!=0):
			data_name_c.append(search_namecountry(l))
			active_country = 1
		elif(active_country and (search_idcountry(l)!=0)):
			data_ids.append(search_idcountry(l))
			active_country = 0
			


#print(data_d)
print(len(data_d))
#print(data_d)
print(len(data_name_c))
print(data_name_c)


def copy_in_file(file_dest,donnees):
	f = open(file_dest, 'a+')
	for d in donnees:
		f.write(""+d+"\n")


file_path = "extract_path.txt"
file_namec = "extract_name_c.txt"
file_ids = "extract_ids.txt"
copy_in_file(file_path,data_d)
copy_in_file(file_namec,data_name_c)
copy_in_file(file_ids,data_ids)