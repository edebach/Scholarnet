PGDMP                         {        
   Scholarnet    15.2    15.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16403 
   Scholarnet    DATABASE        CREATE DATABASE "Scholarnet" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Italian_Italy.1252';
    DROP DATABASE "Scholarnet";
                postgres    false            �            1259    16404    utente    TABLE     �   CREATE TABLE public.utente (
    nome character varying(25),
    cognome character varying(25),
    email character varying(50),
    pass character varying(25),
    istituto character varying(50)
);
    DROP TABLE public.utente;
       public         heap    postgres    false            �          0    16404    utente 
   TABLE DATA           F   COPY public.utente (nome, cognome, email, pass, istituto) FROM stdin;
    public          postgres    false    214   �       �   �   x�=MI
�0<K�1��
����E������W4�eF3�
5W!1��A�8oCL�7�f������y��2�:3v�8s7�)sh�1�o�>�����n�UE��@�x��+���Q���
qV���&qM8+D���?�     