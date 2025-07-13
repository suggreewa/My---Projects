import hashlib
import sys

def hash_password(password, hash_type):
    if hash_type == "md5":
        return hashlib.md5(password.encode()).hexdigest()
    elif hash_type == "sha1":
        return hashlib.sha1(password.encode()).hexdigest()
    elif hash_type == "sha256":
        return hashlib.sha256(password.encode()).hexdigest()
    elif hash_type == "sha512":
        return hashlib.sha512(password.encode()).hexdigest()
    else:
        print("[-] Unsupported hash type.")
        sys.exit(1)

def main():
    if len(sys.argv) != 4:
        print("Usage: python hash_cracker.py <hash> <hash_type> <wordlist>")
        print("Example: python hash_cracker.py e99a18c428cb38d5f260853678922e03 md5 rockyou.txt")
        sys.exit(1)

    target_hash = sys.argv[1]
    hash_type = sys.argv[2].lower()
    wordlist_path = sys.argv[3]

    try:
        with open(wordlist_path, 'r', encoding='utf-8', errors='ignore') as file:
            for line in file:
                password = line.strip()
                hashed = hash_password(password, hash_type)
                if hashed == target_hash:
                    print(f"[+] Password found: {password}")
                    return
            print("[-] Password not found in wordlist.")
    except FileNotFoundError:
        print(f"[-] Wordlist file '{wordlist_path}' not found.")
    except KeyboardInterrupt:
        print("\n[!] Exiting...")

if __name__ == "__main__":
    main()
